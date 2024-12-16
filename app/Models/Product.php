<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'quantity', 'sell_price','image'];

    public function components()
    {
        return $this->belongsToMany(Component::class,'product_component')
        ->withPivot('quantity_per_product')
        ->withTimestamps();
    }
}
