<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body_md',
        'code_snippet',
        'multiple_correct',
        'explanation_md',
        'difficulty',
        'category',
        'source',
    ];

    protected $casts = [
        'multiple_correct' => 'bool',
    ];

    public function options()
    {
        return $this->hasMany(Option::class)->orderBy('position')->orderBy('label');
    }

    public function correctOptions()
    {
        return $this->options()->where('is_correct', true);
    }
}
