<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizAnswer extends Model
{
    use HasUlids;

    protected $fillable = [
        'quiz_session_id',
        'question_id',
        'selected_labels',
        'is_correct',
        'answered_at',
    ];

    protected $casts = [
        'selected_labels' => 'array',
        'is_correct' => 'boolean',
        'answered_at' => 'datetime',
    ];

    public function quizSession(): BelongsTo
    {
        return $this->belongsTo(QuizSession::class);
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
