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
    public function product()
    {
        return $this->hasOne(ProductModel::class,'id' , 'product_id');
    }
    public function productSku()
    {
        return $this->hasOne(ProductSkuModel::class,'id' , 'sku_id');
    }
    public function optionValue()
    {
        return $this->hasOne(OptionValueModel::class,'id' , 'option_value_id  ');
    }
    public function option()
    {
        return $this->hasOne(OptionModel::class,'id' , 'option_id ');
    }

}
