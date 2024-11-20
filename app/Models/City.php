<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'city_id';
    protected $fillable = [
        'city_name',
        'province_id',
        'type',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }

    public function district()
    {
        return $this->hasMany(District::class, 'city_id', 'city_id');
    }
}
