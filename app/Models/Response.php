<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    //
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    protected $fillable = ['user_id', 'question_id', 'answer', 'exam_id'];
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function questions()
    {
        return $this->belongsTo(Question::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getStatusAttribute($value)
    {
        return $value == self::STATUS_ACTIVE ? 'Active' : 'Inactive';
    }
}
