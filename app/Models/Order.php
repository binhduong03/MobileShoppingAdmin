<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'tb_order';
    protected $primaryKey = 'order_id';
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'address',
        'phone',
        'email',
        'quantity',
        'total_amount',
        'status'
    ];

    // Quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id')
                    ->with('product');
    }


}

