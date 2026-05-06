<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'challenge_id',
        'code',
        'passed_tests',
        'total_tests',
        'time_taken',
        'completed_in_time',
        'bonus_earned'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }

    // دالة للحصول على الوقت المستغرق بشكل منسق
    public function getFormattedTimeTakenAttribute()
    {
        if (!$this->time_taken) return null;
        
        $minutes = floor($this->time_taken / 60);
        $seconds = $this->time_taken % 60;
        return "{$minutes}:".str_pad($seconds, 2, '0', STR_PAD_LEFT);
    }
}