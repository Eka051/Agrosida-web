<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'status',
    ];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_detail_id');
    }
}
