<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar', 'title_en', 'parent_id',
        'banner', 'icon', 'slug', 'meta_title', 'meta_description'
    ];
    protected $appends = ['title'];

    public function getIconAttribute($image)
    {
        if (!empty($image)){
            return asset('uploads/categories').'/'.$image;
        }
        return "default.jpg";
    }

    public function setIconAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'categories');
            $this->attributes['icon'] = $imageFields;
        }
    }

    public function getBannerAttribute($image)
    {
        if (!empty($image)){
            return asset('uploads/categories').'/'.$image;
        }
        return "default.jpg";
    }

    public function setBannerAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'categories');
            $this->attributes['banner'] = $imageFields;
        }
    }


    public function getTitleAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->title_ar;
        } else {
            return $this->title_en;
        }
    }

    public function ParentCategory()
    {
        return $this->hasOne('App\Models\Category', 'id', 'parent_id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function Attributes()
    {
        return $this->hasMany(Attribute::class,'category_id');
    }

}
