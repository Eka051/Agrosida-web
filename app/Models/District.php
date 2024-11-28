<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $primaryKey = 'district_id';
    protected $fillable = [
        'district_name',
        'city_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'city_id');
    }

    public function villages()
    {
        return $this->hasMany(Village::class, 'district_id', 'district_id');
    }
}
