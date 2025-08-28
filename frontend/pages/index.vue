<template>
  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 px-4">
    <h1 class="text-4xl font-bold mb-4 text-center mt-10 sm:mt-0">
      PHP Certification Study
    </h1>
    <Logo />
    <p class="text-lg text-gray-700 mb-8 text-center max-w-2xl">
      Test your PHP knowledge with our comprehensive quiz system.
      Take practice quizzes to prepare for your PHP certification exam.
    </p>

    <div class="bg-white shadow-md rounded-lg p-6 w-full max-w-md text-center">
      <h2 class="text-2xl font-semibold mb-4">Ready to start?</h2>
      <p class="text-gray-600 mb-6">
        Take a quiz with 30 random questions from our PHP certification question bank.
      </p>
      <NuxtLink
        to="/quiz/start"
        class="inline-block bg-blue-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-600 transition-colors"
      >
        Start Quiz
      </NuxtLink>
    </div>

    <div class="mt-8">
      <p class="text-sm text-gray-600 text-center">
        <NuxtLink to="/quiz/start" class="text-blue-500 hover:underline">
          Start Quiz
        </NuxtLink>
      </p>
    </div>
  </div>
</template>

<script setup>
definePageMeta({
  name: 'Home',
});

useSeoMeta({
  title: 'PHP Certification Study - Practice Quiz',
  description: 'Test your PHP knowledge with our comprehensive quiz system. Practice for your PHP certification exam.',
  ogImage: '@/assets/images/logo.png',
})
</script>
