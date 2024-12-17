<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = ['name'];

    public function dosages()
    {
        return $this->hasMany(Dosage::class);
    }
}
