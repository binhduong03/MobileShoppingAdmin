<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tb_product';
    protected $primaryKey = 'product_id';
    public $timestamps = false; 

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'type',
        'is_active'
    ];
}
