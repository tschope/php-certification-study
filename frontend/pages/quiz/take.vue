<script setup lang="ts">
import { useQuizStore } from '~/stores/quiz'
import { useApi } from '~/composables/useApi'
import Button from 'primevue/button'
import Checkbox from 'primevue/checkbox'
import RadioButton from 'primevue/radiobutton'
import Card from 'primevue/card'
import ProgressBar from 'primevue/progressbar'
import Markdown from 'vue3-markdown-it'

const quiz = useQuizStore()
const { $fetchApi } = useApi()

const q = computed(() => quiz.questions[quiz.index])
const selected = ref<string[]>([])
const selectedSingle = ref<string>('')

watch(q, (val) => {
  if (!val) return
  const savedAnswers = quiz.answers[val.id] ?? []
  if (val.multiple_correct) {
    selected.value = savedAnswers
  } else {
    selectedSingle.value = savedAnswers[0] || ''
  }
})

async function submitAndNext() {
  if (!q.value) return

  const selectedLabels = q.value.multiple_correct
    ? selected.value
    : selectedSingle.value ? [selectedSingle.value] : []

  // Ensure selectedLabels is always an array and not empty
  const labelsArray = Array.isArray(selectedLabels) ? selectedLabels : [selectedLabels].filter(Boolean)

  if (labelsArray.length === 0) {
    alert('Please select an answer before proceeding.')
    return
  }

  const body = {
    question_id: q.value.id,
    selected_labels: labelsArray
  }

  console.log('Submitting:', JSON.stringify(body)) // Debug log

  try {
    await $fetchApi(`/quiz/${quiz.quizId}/answer`, {
      method: 'POST',
      body: JSON.stringify(body),
      headers: {
        'Content-Type': 'application/json'
      }
    })

    quiz.answers[q.value.id] = [...labelsArray]

    if (quiz.index < quiz.questions.length - 1) {
      quiz.index++
    } else {
      const res = await $fetchApi(`/quiz/${quiz.quizId}/finish`, { method: 'POST' }) as any
      quiz.finished = true
      quiz.result = res
      navigateTo('/quiz/result')
    }
  } catch (error) {
    console.error('Error submitting answer:', error)
    alert('Error submitting answer. Please try again.')
  }
}
</script>

<template>
  <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4" v-if="q">
    <div class="w-full max-w-4xl">
      <!-- Progress Bar -->
      <div class="mb-6">
        <div class="flex justify-between items-center mb-2">
          <span class="text-sm font-medium text-gray-600">
            Question {{ quiz.index + 1 }} of {{ quiz.questions.length }}
          </span>
          <span class="text-sm font-medium text-gray-600">
            {{ Math.round(((quiz.index + 1) / quiz.questions.length) * 100) }}%
          </span>
        </div>
        <ProgressBar
          :value="((quiz.index + 1) / quiz.questions.length) * 100"
          class="h-2"
        />
      </div>

      <!-- Main Quiz Card -->
      <Card class="shadow-lg">
        <template #header>
          <div class="p-6 pb-0">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">
              Question {{ quiz.index + 1 }}
            </h1>
            <div class="prose max-w-none">
              <Markdown :source="q.body_md" />
            </div>
            <pre v-if="q.code_snippet" class="mt-4 p-4 bg-gray-100 rounded-lg overflow-x-auto"><code>{{ q.code_snippet }}</code></pre>
          </div>
        </template>

        <template #content>
          <div class="px-6 pb-6">
            <div class="mb-6">
              <p class="text-sm text-gray-600 mb-4">
                {{ q.multiple_correct ? 'Select all that apply:' : 'Select one answer:' }}
              </p>

              <div class="space-y-4">
                <div v-for="opt in q.options" :key="opt.label"
                     class="flex items-start gap-3 p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-colors">
                  <div class="flex-shrink-0 mt-1">
                    <Checkbox v-if="q.multiple_correct"
                      :inputId="`opt-${q.id}-${opt.label}`"
                      :value="opt.label"
                      v-model="selected" />
                    <RadioButton v-else
                      :inputId="`opt-${q.id}-${opt.label}`"
                      :value="opt.label"
                      v-model="selectedSingle" />
                  </div>
                  <label :for="`opt-${q.id}-${opt.label}`" class="cursor-pointer flex-1">
                    <div class="flex items-start gap-2">
                      <span class="font-semibold text-blue-600 text-sm">{{ opt.label.toUpperCase() }})</span>
                      <div class="flex-1" v-html="opt.text_md"></div>
                    </div>
                  </label>
                </div>
              </div>
            </div>

            <div class="flex justify-between items-center pt-4 border-t border-gray-200">
              <div class="text-sm text-gray-500">
                {{ q.multiple_correct ? 'Multiple answers allowed' : 'Single answer only' }}
              </div>
              <Button
                label="Next Question"
                icon="pi pi-arrow-right"
                iconPos="right"
                @click="submitAndNext"
                class="px-6 py-2"
                :disabled="(q.multiple_correct ? selected.length === 0 : !selectedSingle)"
              />
            </div>
          </div>
        </template>
      </Card>
    </div>
  </div>
</template>
