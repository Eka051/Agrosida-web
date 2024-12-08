<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'category_id';
    protected $fillable = [
        'category_id',
        'name'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_id');
    }
}
