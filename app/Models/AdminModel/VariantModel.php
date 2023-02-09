<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantModel extends Model
{
    use HasFactory;
    protected $table = 'variants';
    protected $fillable = [
        'product_id','sku_id','option_id','option_value_id'
    ];

}
