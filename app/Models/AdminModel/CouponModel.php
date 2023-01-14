<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponModel extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $fillable = ['name', 'code', 'type', 'stock', 'time_start', 'time_end', 'value', 'activated'];
    public function getRouteKeyName()
    {
        return 'name';
    }
    public function type()
    {
        if($this->type == 0){
            return "<span class='badge badge-primary'>Cash</span>";
        }
        else{
            return "<span class='badge badge-info'>Percentage</span>";
        }
    }
 

    public function value()
    {
        if($this->type == 0){
            return number_format($this->value,0,",",".") . ' ' . 'VNĐ';
        }
        return number_format($this->value,0,",",".") . '%';
    }
}
