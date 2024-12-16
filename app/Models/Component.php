<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description'
        ,'image'
        , 'price'
        , 'dimensions'
        , 'price_per_unit'
        ,'material_id'];

    public function products()  
    {
        return $this->belongsToMany(Product::class,'product_component')
        ->withPivot('quantity_per_product', 'material_id')
        ->withTimestamps();
    }
    public function material()
    {
        return $this->hasOne(Material::class);
    }
    
}
