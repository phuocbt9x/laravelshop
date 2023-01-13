<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValueModel extends Model
{
    use HasFactory;
    protected $table = 'option_values';
    protected $fillable = ['value', 'slug', 'option_id', 'activated'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function option()
    {
        return $this->belongsTo(OptionModel::class, 'option_id', 'id');
    }

    public function status()
    {
        if ($this->activated) {
            return "<span class='badge badge-primary'>Hiển thị</span>";
        }
        return "<span class='badge badge-danger'>Ẩn</span>";
    }
}
