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
    
    public function manufacturer()
    {
        return $this->hasOne(ManufactureModel::class,'id' , 'manufacturer_id');
    }

    public function optionProduct()
    {
        return $this->belongsToMany(OptionValueModel::class,'options_products','product_id', 'option_value_id','id','id')->withPivot('option_id');
    }
    public function category()
    {
        return $this->hasOne(CategoryModel::class,'id' , 'category_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function Price()
    {
        return  number_format($this->price,0,",",".")  . 'VNĐ';
    }

    public function manufacturer_name()
    {
        return $this->manufacturer()->first()->name;
    }

    public function category_name()
    {
        return $this->category()->first()->name;
    }

    
}
