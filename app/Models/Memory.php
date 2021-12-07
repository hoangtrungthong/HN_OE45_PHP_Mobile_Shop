<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Memory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'memories';

    protected $fillable = [
        'rom',
    ];

    public function productAttribute()
    {
        return $this->belongsTo(ProductAttribute::class);
    }
}
