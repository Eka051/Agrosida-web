<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $primaryKey = 'address_id';
    protected $fillable = [
        'user_id',
        'province_id',
        'city_id',
        'district_id',
        'village_id',
        'street_address',
        'additional_info',
    ];
}
