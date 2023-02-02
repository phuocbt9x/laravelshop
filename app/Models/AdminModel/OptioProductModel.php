<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptioProductModel extends Model
{
    use HasFactory;
    protected $table = 'option_products';
    protected $fillable = [
        'product_id', 'option_id', 'option_value_id'
    ];
}
