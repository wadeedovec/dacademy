<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    protected $fillable = ['name', 'description', 'status'];
    protected function casts(): array
    {
        return [
            'status' => 'integer',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }
    public function getStatusAttribute($value)
    {
        return $value == self::STATUS_ACTIVE ? 'Active' : 'Inactive';
    }
    public function questions()
    {
        return $this->hasMany(question::class);
    }
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
