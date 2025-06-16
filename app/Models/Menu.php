<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = 'tb_menu';
    protected $primaryKey = 'menu_id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'image',
        'status',
    ];
}
