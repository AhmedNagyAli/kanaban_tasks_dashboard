<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'responsable_name',
        'address',
        'country',
        'city',
    ];

    public function componentSuppliers()
    {
        return $this->belongsToMany(Component::class,'component_supplier');
    }
}
