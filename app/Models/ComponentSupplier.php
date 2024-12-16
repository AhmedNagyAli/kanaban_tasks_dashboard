<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentSupplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'supplier_id',
        'component_id',
        'price',
    ];

    public function supplier()
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function component()
    {
        return $this->belongsToMany(Component::class);
    }
}
