<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionModel extends Model
{
    use HasFactory;
    protected $table = 'options';
    protected $fillable = ['name', 'slug', 'activated'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function optionValue()
    {
        return $this->hasMany(OptionValueModel::class, 'option_id', 'id');
    }
    public function status()
    {
        if ($this->activated) {
            return "<span class='badge badge-primary'>Hiển thị</span>";
        }
        return "<span class='badge badge-danger'>Ẩn</span>";
    }

    public function getOptionValue()
    {
        $arr = [];
        $values = $this->optionValue()->get();
        foreach($values as $value){
            array_push($arr,$value->value);
        }
        return $arr ;
    }
}
