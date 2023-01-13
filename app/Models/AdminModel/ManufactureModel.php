<?php

namespace App\Models\AdminModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManufactureModel extends Model
{
    use HasFactory;
    protected $table = 'manufactures';
    protected $fillable = [
        'name','slug','logo','website','phone','activated'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
