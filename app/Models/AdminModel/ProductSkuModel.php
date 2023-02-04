<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSkuModel extends Model
{
    use HasFactory;
    protected $table = 'product_skus';
    protected $fillable = [
        'product_id','option_product_id' , 'price', 'quantity', 'thumbnail', 'activated'
    ];
}
