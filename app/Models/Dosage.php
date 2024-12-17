<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosage extends Model
{
    use HasFactory;
    protected $fillable = [
        'plant_id',
        'pesticide_id',
        'dosage_per_hectare',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    public function pesticide()
    {
        return $this->belongsTo(Pesticide::class);
    }
}
