<script setup lang="ts">
import { useQuizStore } from '~/stores/quiz'
import Button from 'primevue/button'
import Card from 'primevue/card'
import ProgressBar from 'primevue/progressbar'
const quiz = useQuizStore()

const getScoreColor = (percentage: number) => {
  if (percentage >= 80) return 'text-green-600'
  if (percentage >= 60) return 'text-yellow-600'
  return 'text-red-600'
}

const getScoreMessage = (percentage: number) => {
  if (percentage >= 90) return 'Excellent! 🎉'
  if (percentage >= 80) return 'Great job! 👏'
  if (percentage >= 70) return 'Good work! 👍'
  if (percentage >= 60) return 'Not bad! 📚'
  return 'Keep studying! 💪'
}
</script>

<template>
  <div class="min-h-screen bg-gray-50 flex items-center justify-center p-4" v-if="quiz.result">
    <div class="w-full max-w-2xl">
      <Card class="shadow-lg text-center">
        <template #header>
          <div class="p-8 pb-0">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Quiz Complete!</h1>
            <p class="text-lg text-gray-600">{{ getScoreMessage(quiz.result.score_percent) }}</p>
          </div>
        </template>

        <template #content>
          <div class="px-8 pb-8">
            <!-- Score Display -->
            <div class="mb-8">
              <div class="text-6xl font-bold mb-4" :class="getScoreColor(quiz.result.score_percent)">
                {{ quiz.result.score_percent }}%
              </div>
              <div class="text-xl text-gray-700 mb-4">
                {{ quiz.result.correct }} out of {{ quiz.result.total }} correct
              </div>
              <ProgressBar
                :value="quiz.result.score_percent"
                class="h-3 mb-2"
                :pt="{ value: { class: getScoreColor(quiz.result.score_percent).replace('text-', 'bg-') } }"
              />
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-4 mb-8 text-center">
              <div class="p-4 bg-green-50 rounded-lg">
                <div class="text-2xl font-bold text-green-600">{{ quiz.result.correct }}</div>
                <div class="text-sm text-green-700">Correct</div>
              </div>
              <div class="p-4 bg-red-50 rounded-lg">
                <div class="text-2xl font-bold text-red-600">{{ quiz.result.total - quiz.result.correct }}</div>
                <div class="text-sm text-red-700">Incorrect</div>
              </div>
              <div class="p-4 bg-blue-50 rounded-lg">
                <div class="text-2xl font-bold text-blue-600">{{ quiz.result.total }}</div>
                <div class="text-sm text-blue-700">Total</div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
              <Button
                label="Review Answers"
                icon="pi pi-eye"
                @click="navigateTo('/quiz/review')"
                class="px-6 py-3"
              />
              <Button
                label="Start New Quiz"
                icon="pi pi-refresh"
                severity="secondary"
                @click="navigateTo('/quiz/start')"
                class="px-6 py-3"
              />
            </div>
          </div>
        </template>
      </Card>
    </div>
  </div>
</template>
