<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'tb_contact';
    protected $primaryKey = 'contact_id'; 
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'message',
        'is_read'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}