<?php

namespace ShoppingCart;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'image_path',
        'title',
        'description',
        'price'
    ];
}
