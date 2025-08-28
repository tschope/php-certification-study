<?php

namespace App\Http\Requests;

use App\Models\Question;
use App\Models\Option;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubmitAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'question_id' => ['required', 'integer', 'exists:questions,id'],
            'selected_labels' => ['required', 'array', 'min:1'],
            'selected_labels.*' => ['string', 'min:1', 'max:8'],
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $questionId = $this->input('question_id');
            $selectedLabels = $this->input('selected_labels', []);

            if ($questionId && !empty($selectedLabels) && is_array($selectedLabels)) {
                $question = Question::find($questionId);

                if ($question) {
                    // Get valid labels for this question
                    $validLabels = Option::where('question_id', $questionId)
                        ->pluck('label')
                        ->map(function($label) {
                            return strtolower((string)$label);
                        })
                        ->toArray();

                    // Check if all selected labels are valid
                    foreach ($selectedLabels as $label) {
                        if (is_string($label) && !in_array(strtolower($label), $validLabels)) {
                            $validator->errors()->add('selected_labels', "Invalid label: {$label}");
                        }
                    }

                    // Check single vs multiple selection constraint
                    if (!$question->multiple_correct && count($selectedLabels) > 1) {
                        $validator->errors()->add('selected_labels', 'This question allows only one answer.');
                    }
                }
            }
        });
    }
}
