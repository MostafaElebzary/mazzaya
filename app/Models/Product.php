<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "title_ar","title_en","model_ar","model_en","category_id","brand_id","unit_ar","unit_en",
        "main_image","description_ar","description_en","price","discount_type","discount","quantity",
        "min_quantity","meta_title","meta_description"
    ];

    protected $appends = ['title','model','description','unit','end_price'];

    public function Reviews()
    {
        return $this->hasMany(Review::class,'product_id');
    }

    public function Images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function Attributes()
    {
        return $this->hasMany(ProductAttribute::class,'product_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function is_favourite()
    {
        $count = Favourite::where(['user_id' => Auth::id(), 'product_id' => $this->id])->count();
        if ($count > 0){
            return true;
        }
        return false;
    }

    public function getEndPriceAttribute()
    {
        if( $this->attributes['discount_type'] == "ratio"){
            return $this->attributes['price'] - ($this->attributes['price'] * $this->attributes['discount'] /100 );
        }else{
           return $this->attributes['price'] -$this->attributes['discount'];
        }
    }

    public function getMainImageAttribute($image)
    {
        if (!empty($image)){
            return asset('uploads/products').'/'.$image;
        }
        return "default.jpg";
    }

    public function setMainImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'products');
            $this->attributes['main_image'] = $imageFields;
        }
    }

    public function Brand()
    {
        return $this->hasOne('App\Models\Brand', 'id', 'brand_id');
    }

    public function Category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function getTitleAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->title_ar;
        } else {
            return $this->title_en;
        }
    }
    public function getUnitAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->unit_ar;
        } else {
            return $this->unit_en;
        }
    }
    public function getModelAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->model_ar;
        } else {
            return $this->model_en;
        }
    }public function getDescriptionAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->description_ar;
        } else {
            return $this->description_en;
        }
    }
}
