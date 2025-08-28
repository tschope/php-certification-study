<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizSession extends Model
{
    use HasUlids;

    protected $fillable = [
        'user_id',
        'started_at',
        'completed_at',
        'total_questions',
        'correct_count',
        'score_percent',
        'meta',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'meta' => 'array',
        'score_percent' => 'decimal:2',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(QuizAnswer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
