<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
//    public $table = 'products';

    public function Category()
    {
        return $this->belongsToMany(Product::class);
    }
}
