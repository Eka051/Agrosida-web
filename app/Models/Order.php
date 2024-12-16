<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'order_id',
        'status',
        'snap_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id', 'order_id');
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class, 'order_id', 'order_id');
    }

    public function cancelOrder()
    {
        $orderDetail = $this->order_detail;
        foreach ($orderDetail as $detail) {
            $product = Product::find($detail->product_id);
            if ($product) {
                $product->stock += $detail->quantity;
                $product->save();
            }
        }

        $this->status = 'canceled';
        $this->save();
    }
}
