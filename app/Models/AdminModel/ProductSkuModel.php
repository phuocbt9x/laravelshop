<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSkuModel extends Model
{
    use HasFactory;
    protected $table = 'product_skus';
    protected $fillable = [
        'product_id', 'sku' , 'price', 'stock', 'thumbnail', 'activated'
    ];

    public function product()
    {
        return $this->hasOne(ProductModel::class,'id' , 'product_id');
    }
}
