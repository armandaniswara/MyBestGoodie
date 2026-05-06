<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name", "image", "category", "description", "price"];

    public function custom_designs()
    {
        return $this->hasMany(DetailProduct::class, 'product_id');
    }

    public function colors()
    {
        // Mengasumsikan nama table adalah product_colors
        return $this->hasMany(ProductColor::class, 'product_id');
    }
}
