<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lesson extends Model
{
    protected $fillable = [
        'chapter_id',
        'name',
        'content',
        'video_url',
        'order',
        'duration',
    ];

    protected $casts = [
        'order' => 'integer',
        'duration' => 'integer',
    ];

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function quizzes(): HasMany
    {
        return $this->hasMany(Quiz::class);
    }

    public function userProgress(): HasMany
    {
        return $this->hasMany(UserProgress::class);
    }
}
