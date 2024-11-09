<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuthProvider extends Model
{
    protected $fillable = ['provider', 'provider_id', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
