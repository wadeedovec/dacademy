<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $fillable = [
        'exam_id',    
        'content',   
        'category',
        'status',
    ];
    protected function casts(): array
    {
        return [
            'status' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    // Relationship: A question belongs to an exam
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    // (Optional) Relationship: A question can have multiple user responses
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
    public function getStatusAttribute($value)
    {
        return $value == self::STATUS_ACTIVE ? 'Active' : 'Inactive';
    }
}
