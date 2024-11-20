<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $primaryKey = 'province_id';
    protected $fillable = ['province_name'];

    public function cities()
    {
        return $this->hasMany(City::class, 'province_id', 'province_id');
    }

}
