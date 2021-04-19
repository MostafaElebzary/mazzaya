<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', 'attribute_id',
        'option_id', 'value_ar',
        'value_en','additional_price'
    ];

    protected $appends = ['value'];

    public function getValueAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->value_ar;
        } else {
            return $this->value_en;
        }
    }

    public function Product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

    public function Attribute()
    {
        return $this->hasOne('App\Models\Attribute', 'id', 'attribute_id')->with('Option');
    }

    public function Option()
    {
        return $this->hasOne('App\Models\Option', 'id', 'option_id');
    }
}
