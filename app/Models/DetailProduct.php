<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailProduct extends Model
{
    protected $table = "product_colors";

    protected $fillable = ['product_id', 'name', 'image', 'color_code'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
