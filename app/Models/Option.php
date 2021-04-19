<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar', 'name_en',
          'attribute_id',
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

    public function Attribute()
    {
        return $this->hasOne('App\Models\Attribute', 'id', 'attribute_id');
    }
}
