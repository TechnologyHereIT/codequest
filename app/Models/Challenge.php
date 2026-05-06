<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description', 
        'instructions',
        'starter_code',
        'solution',
        'difficulty',
        'points',
        'test_cases',
        'time_limit',
        'bonus_points'
    ];

    protected $casts = [
        'test_cases' => 'array'
    ];

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function completedBy()
    {
        return $this->belongsToMany(User::class, 'completions');
    }

    // دالة للحصول على الوقت المتبقي بشكل منسق
    public function getFormattedTimeLimitAttribute()
    {
        $minutes = floor($this->time_limit / 60);
        $seconds = $this->time_limit % 60;
        return "{$minutes}:".str_pad($seconds, 2, '0', STR_PAD_LEFT);
    }
}