<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name', 'slug', 'parent_id', 'activated'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function parentCategory()
    {
        return $this->belongsTo(CategoryModel::class, 'parent_id')->withDefault();
    }

    public function childrenCategories()
    {
        return $this->hasMany(CategoryModel::class, 'parent_id', 'id');
    }

    public function status()
    {
        if ($this->activated) {
            return "<span class='badge badge-primary'>Hiển thị</span>";
        }
        return "<span class='badge badge-danger'>Ẩn</span>";
    }
}
