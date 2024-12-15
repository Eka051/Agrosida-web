<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'order_id',
        'status',
        'courier_name',
        'courier_service',
        'shipping_cost',
        'detail_address',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
