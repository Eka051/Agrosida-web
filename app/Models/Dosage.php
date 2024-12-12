<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosage extends Model
{
    use HasFactory;

    // Nama tabel (opsional jika sesuai konvensi Laravel)
    protected $table = 'dosages';

    // Kolom yang dapat diisi (fillable)
    protected $fillable = [
        'plant_id',
        'pesticide_id',
        'dosage_per_hectare',
    ];

    /**
     * Relasi ke model Plant
     */
    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    /**
     * Relasi ke model Pesticide
     */
    public function pesticide()
    {
        return $this->belongsTo(Pesticide::class);
    }
}
