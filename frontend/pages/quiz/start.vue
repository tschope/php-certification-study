<script setup lang="ts">
import { useQuizStore } from '~/stores/quiz'
import { useApi } from '~/composables/useApi'
import Card from 'primevue/card'
import Button from 'primevue/button'
import ProgressSpinner from 'primevue/progressspinner'

const quiz = useQuizStore()
const { $fetchApi } = useApi()
const loading = ref(true)
const error = ref('')

onMounted(async () => {
  try {
    quiz.reset()
    const res = await $fetchApi('/quiz/start', {
      method: 'POST',
      body: { count: 30 }
    }) as any
    quiz.quizId = res.quiz_id
    quiz.questions = res.questions
    navigateTo('/quiz/take')
  } catch (err) {
    error.value = 'Failed to start quiz. Please try again.'
    loading.value = false
  }
})
</script>

<template>
  <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4">
    <Card class="shadow-lg text-center w-full max-w-md">
      <template #content>
        <div class="p-8">
          <div v-if="loading && !error">
            <ProgressSpinner class="mb-4" />
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Starting Your Quiz</h2>
            <p class="text-gray-600">Loading 30 random questions...</p>
          </div>

          <div v-if="error" class="text-center">
            <div class="text-red-500 text-4xl mb-4">⚠️</div>
            <h2 class="text-xl font-semibold text-red-600 mb-2">Error</h2>
            <p class="text-gray-600 mb-4">{{ error }}</p>
            <Button
              label="Try Again"
              icon="pi pi-refresh"
              @click="navigateTo('/quiz/start')"
            />
          </div>
        </div>
      </template>
    </Card>
  </div>
</template>
