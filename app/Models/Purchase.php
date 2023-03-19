<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'supplier_id',
        'buying_price',
        
        'purchase_date',
        
        'batch_no',
        
        'total_qty',
        'available_qty',
        'barcode',
        'carat',
        'weight',
        'bangla_weight',
        'name',
        'sku',
        'thumbnail',
        'description'
    ];
}
