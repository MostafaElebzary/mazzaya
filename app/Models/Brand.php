<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar', 'title_en',
        'logo',  'meta_title', 'meta_description'
    ];

    protected $appends = ['title'];

    public function getTitleAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->title_ar;
        } else {
            return $this->title_en;
        }
    }
    public function getLogoAttribute($image)
    {
        if (!empty($image)){
            return asset('uploads/brands').'/'.$image;
        }
        return "default.jpg";
    }

    public function setLogoAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'brands');
            $this->attributes['logo'] = $imageFields;
        }
    }
}
