<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [

        'name',
        'sku',
        'thumbnail',
        'images',
        'description',
        'status',
        'carat',
        'weight',
        'bangla_weight',
        'gold_weight',
        'diamond_weight',
        'diamond_piece'
    ];
}
