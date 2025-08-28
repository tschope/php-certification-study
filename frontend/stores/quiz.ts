import { defineStore } from 'pinia'

type Option = { label: string; text_md: string }
type Question = {
  id: number
  body_md: string
  code_snippet: string | null
  multiple_correct: boolean
  options: Option[]
}

export const useQuizStore = defineStore('quiz', {
  state: () => ({
    quizId: '' as string,
    questions: [] as Question[],
    index: 0,
    answers: {} as Record<number, string[]>, // questionId -> selected labels
    finished: false,
    result: null as null | {
      total: number
      correct: number
      score_percent: number
      incorrect: any[]
    }
  }),
  actions: {
    reset() {
      this.quizId = ''
      this.questions = []
      this.index = 0
      this.answers = {}
      this.finished = false
      this.result = null
    }
  }
})
