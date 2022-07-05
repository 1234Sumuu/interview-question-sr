<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // use HasFactory;
    // protected $table = "ProductVariant";
    protected $fillable = [
        'title', 'sku', 'description'
    ];

    public function ProductVariant(){
        $this->belongsTo(ProductVariant::class);
    }

}