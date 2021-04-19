<?php

namespace App\Models;

use Carbon\Traits\Options;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_ar', 'name_en',
        'type', 'category_id',
    ];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->name_ar;
        } else {
            return $this->name_en;
        }
    }

    public function Category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function Options()
    {
        return $this->hasMany(Option::class,'attribute_id');
    }

}
