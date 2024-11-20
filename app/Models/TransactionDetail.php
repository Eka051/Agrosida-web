<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $primaryKey = 'transaction_detail_id';
    protected $fillable = [
        'transaction_id',
        'product_id',
        'product_name',
        'quantity',
        'price',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
