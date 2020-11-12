<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'model',
        'size',
        'price',
        'weight',
        'quality',
        'created_at',
        'updated_at',
    ];

    public function image()
    {
        return $this->hasMany(Image::class, 'product_id', 'id');
    }

}
