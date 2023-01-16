<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name', 'slug', 'price', 'thumbnail', 'quantity', 'decrisption', 'manufacturer_id', 'category_id', 'activated'
    ];
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
