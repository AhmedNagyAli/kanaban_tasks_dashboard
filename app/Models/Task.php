<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_id',
        'task_user',
        'started_at',
        'end_date',
        'status',
    ];

    protected $dates = [
        'started_at',
        'end_date',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function category()
    {
        return $this->hasMany(related: Category::class);
    }
    public function comment(){
        return $this->hasMany(TaskComment::class);
    }
}
