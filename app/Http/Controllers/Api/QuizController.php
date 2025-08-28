<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StartQuizRequest;
use App\Http\Requests\SubmitAnswerRequest;
use App\Models\Option;
use App\Models\Question;
use App\Models\QuizAnswer;
use App\Models\QuizSession;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function start(StartQuizRequest $request)
    {
        $count = $request->input('count', 30);

        $questions = Question::inRandomOrder()
            ->take($count)
            ->with(['options' => function ($q) {
                $q->orderBy('position')->orderBy('label');
            }])->get();

        $ids = $questions->pluck('id')->all();

        $quiz = QuizSession::create([
            'total_questions' => count($ids),
            'meta' => ['questions' => $ids],
            'started_at' => now(),
        ]);

        $payload = $questions->map(function (Question $q) {
            return [
                'id' => $q->id,
                'body_md' => $q->body_md,
                'code_snippet' => $q->code_snippet,
                'multiple_correct' => (bool)$q->multiple_correct,
                'options' => $q->options->map(fn($o) => [
                    'label' => $o->label,
                    'text_md' => $o->text_md,
                ])->values(),
            ];
        })->values();

        return response()->json([
            'quiz_id' => (string)$quiz->id,
            'questions' => $payload,
        ]);
    }

    public function answer(SubmitAnswerRequest $request, QuizSession $quiz)
    {
        abort_if($quiz->completed_at, 400, 'Quiz already finished.');

        $questionId = (int)$request->input('question_id');
        $selected = array_values(array_unique(array_map('strtolower', $request->input('selected_labels', []))));
        sort($selected);

        $allowed = Arr::get($quiz->meta, 'questions', []);
        abort_unless(in_array($questionId, $allowed, true), 422, 'Question not in this quiz.');

        $correct = Option::query()
            ->where('question_id', $questionId)
            ->where('is_correct', true)
            ->orderBy('label')
            ->pluck('label')
            ->map(fn($l) => strtolower($l))
            ->values()
            ->all();

        $isCorrect = ($selected === $correct);

        QuizAnswer::query()->updateOrCreate(
            ['quiz_session_id' => $quiz->id, 'question_id' => $questionId],
            ['selected_labels' => $selected, 'is_correct' => $isCorrect, 'answered_at' => now()]
        );

        return response()->json(['saved' => true]);
    }

    public function finish(QuizSession $quiz)
    {
        if (! $quiz->completed_at) {
            $correct = $quiz->answers()->where('is_correct', true)->count();
            $quiz->correct_count = $correct;
            $quiz->score_percent = $quiz->total_questions > 0
                ? round(($correct / $quiz->total_questions) * 100, 2)
                : 0;
            $quiz->completed_at = now();
            $quiz->save();
        }

        $incorrect = $quiz->answers()
            ->where('is_correct', false)
            ->with(['question.options' => fn($q) => $q->orderBy('position')->orderBy('label')])
            ->get()
            ->map(function (QuizAnswer $a) {
                $correctLabels = $a->question->options->where('is_correct', true)->pluck('label')->values();
                return [
                    'question_id' => $a->question_id,
                    'your_labels' => $a->selected_labels ?? [],
                    'correct_labels' => $correctLabels,
                    'question' => [
                        'id' => $a->question->id,
                        'body_md' => $a->question->body_md,
                        'code_snippet' => $a->question->code_snippet,
                    ],
                    'options' => $a->question->options->map(fn($o) => [
                        'label' => $o->label,
                        'text_md' => $o->text_md,
                    ])->values(),
                ];
            })->values();

        return response()->json([
            'quiz_id' => (string)$quiz->id,
            'total' => $quiz->total_questions,
            'correct' => $quiz->correct_count,
            'score_percent' => (float)$quiz->score_percent,
            'incorrect' => $incorrect,
        ]);
    }

    public function review(QuizSession $quiz)
    {
        $answers = $quiz->answers()
            ->with(['question.options' => fn($q) => $q->orderBy('position')->orderBy('label')])
            ->get()
            ->map(function (QuizAnswer $a) {
                $correctLabels = $a->question->options->where('is_correct', true)->pluck('label')->values();
                return [
                    'question_id' => $a->question_id,
                    'your_labels' => $a->selected_labels ?? [],
                    'correct_labels' => $correctLabels,
                    'is_correct' => (bool)$a->is_correct,
                    'question' => [
                        'id' => $a->question->id,
                        'body_md' => $a->question->body_md,
                        'code_snippet' => $a->question->code_snippet,
                    ],
                    'options' => $a->question->options->map(fn($o) => [
                        'label' => $o->label,
                        'text_md' => $o->text_md,
                    ])->values(),
                ];
            })->values();

        return response()->json([
            'quiz_id' => (string)$quiz->id,
            'total' => $quiz->total_questions,
            'answers' => $answers,
        ]);
    }
}
