<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\App\Models\Product;

class ProductVariant extends Model
{
    protected $fillable = [
        'name'
    ];

    public function products{
        // return $this->hasMany('App\Products');
        return $this->hasMany(Product::class);
    }
}