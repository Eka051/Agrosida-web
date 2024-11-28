<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OAuthProvider extends Model
{
    protected $fillable = [
        'provider', 
        'provider_id',
        'user_id'];

    public function user()
    {
        return $this->hasMany(User::class, 'user_id', 'user_id');
    }
}
