<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesticide extends Model
{
    protected $fillable = ['name']; // Tambahkan kolom yang dapat diisi

    public function dosages()
    {
        return $this->hasMany(Dosage::class);
    }
}
