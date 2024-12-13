<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // protected $primaryKey = 'address_id';
    protected $fillable = [
        'user_id',
        'name',
        'province_id',
        'city_id',
        'detail_address',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }

    public function getFullAddressAttribute()
    {
        return "{$this->street_address}, {$this->village->village_name}, {$this->district->district_name}, {$this->city->city_name}, {$this->province->province_name}";
    }
}
