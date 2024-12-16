<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'grade', 'description'];

    public function component()
    {
        return $this->belongsTo(Component::class);
    }
}
