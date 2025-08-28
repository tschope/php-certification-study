<script setup lang="ts">
import { useQuizStore } from '~/stores/quiz'
import { useApi } from '~/composables/useApi'
import Card from 'primevue/card'
import Tag from 'primevue/tag'
import Button from 'primevue/button'
import Markdown from 'vue3-markdown-it'

const quiz = useQuizStore()
const { $fetchApi } = useApi()
const items = ref<any[]>([])

onMounted(async () => {
  const res = await $fetchApi(`/quiz/${quiz.quizId}/review`) as any
  items.value = res.answers
})
</script>

<template>
  <div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4">
      <!-- Header -->
      <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Quiz Review</h1>
        <p class="text-gray-600">Review all questions and see the correct answers</p>
        <div class="mt-4">
          <Button
            label="Back to Results"
            icon="pi pi-arrow-left"
            severity="secondary"
            @click="navigateTo('/quiz/result')"
            class="mr-3"
          />
          <Button
            label="Start New Quiz"
            icon="pi pi-refresh"
            @click="navigateTo('/quiz/start')"
          />
        </div>
      </div>

      <!-- Questions -->
      <div class="space-y-6">
        <Card v-for="(item, index) in items" :key="item.question_id" class="shadow-lg">
          <template #header>
            <div class="p-6 pb-0 flex items-center justify-between">
              <h2 class="text-xl font-semibold text-gray-800">
                Question {{ index + 1 }}
              </h2>
              <Tag
                :value="item.is_correct ? 'Correct' : 'Incorrect'"
                :severity="item.is_correct ? 'success' : 'danger'"
                class="text-sm px-3 py-1"
              />
            </div>
          </template>

          <template #content>
            <div class="px-6 pb-6">
              <!-- Question Text -->
              <div class="prose max-w-none mb-4">
                <Markdown :source="item.question.body_md" />
              </div>

              <!-- Code Snippet -->
              <pre v-if="item.question.code_snippet"
                   class="p-4 bg-gray-100 rounded-lg mb-4 overflow-x-auto">
                <code>{{ item.question.code_snippet }}</code>
              </pre>

              <!-- Answer Options -->
              <div class="space-y-3">
                <div v-for="opt in item.options" :key="opt.label"
                     class="flex items-start gap-3 p-3 rounded-lg border"
                     :class="{
                       'border-green-200 bg-green-50': item.correct_labels && Array.isArray(item.correct_labels) && item.correct_labels.includes(opt.label),
                       'border-red-200 bg-red-50': item.your_labels && Array.isArray(item.your_labels) && item.your_labels.includes(opt.label) && !(item.correct_labels && item.correct_labels.includes(opt.label)),
                       'border-gray-200': !(item.correct_labels && item.correct_labels.includes(opt.label)) && !(item.your_labels && item.your_labels.includes(opt.label))
                     }">
                  <div class="flex-shrink-0">
                    <span class="font-semibold text-blue-600 text-sm">
                      {{ opt.label.toUpperCase() }})
                    </span>
                  </div>
                  <div class="flex-1">
                    <div v-html="opt.text_md" class="mb-2"></div>
                    <div class="flex gap-2">
                      <Tag v-if="item.correct_labels && Array.isArray(item.correct_labels) && item.correct_labels.includes(opt.label)"
                           value="Correct Answer"
                           severity="success"
                           class="text-xs" />
                      <Tag v-if="item.your_labels && Array.isArray(item.your_labels) && item.your_labels.includes(opt.label)"
                           value="Your Choice"
                           :severity="(item.correct_labels && item.correct_labels.includes(opt.label)) ? 'success' : 'danger'"
                           class="text-xs" />
                    </div>
                  </div>
                </div>
              </div>

              <!-- Explanation -->
              <div v-if="!item.is_correct" class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <h4 class="font-semibold text-blue-800 mb-2">Explanation:</h4>
                <p class="text-blue-700 text-sm">
                  The correct answer{{ (item.correct_labels && item.correct_labels.length > 1) ? 's are' : ' is' }}:
                  <strong>{{ item.correct_labels && Array.isArray(item.correct_labels) ? item.correct_labels.join(', ').toUpperCase() : 'N/A' }}</strong>
                </p>
              </div>
            </div>
          </template>
        </Card>
      </div>

      <!-- Footer Actions -->
      <div class="text-center mt-8 pb-8">
        <Button
          label="Start New Quiz"
          icon="pi pi-refresh"
          size="large"
          @click="navigateTo('/quiz/start')"
          class="px-8 py-3"
        />
      </div>
    </div>
  </div>
</template>
