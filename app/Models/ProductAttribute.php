<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttribute extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'product_attributes';

    protected $fillable = [
        'product_id',
        'color_id',
        'memory_id',
        'price',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function colors()
    {
        return $this->hasMany(Color::class);
    }

    public function memories()
    {
        return $this->hasMany(Memory::class);
    }
}
