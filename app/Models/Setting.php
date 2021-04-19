<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar', 'title_en',
        'phone1', 'phone2', 'email1', 'email2', 'address1_ar', 'address1_en',
        'address2_ar', 'address2_en',
        'logo_white', 'logo_black', 'fav_ico',
        'breadcrumb', 'facebook', 'twitter', 'youtube', 'instagram',
        'snapchat', 'linkedin', 'system_time_zone'
    ];



    protected $appends = ['title', 'address1', 'address2'];

    public function getFavIcoAttribute($image)
    {
        if (!empty($image)){
            return asset('uploads/settings').'/'.$image;
        }
        return "default.jpg";
    }

    public function setFavIcoAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'settings');
            $this->attributes['fav_ico'] = $imageFields;
        }
    }


    public function getLogoBlackAttribute($image)
    {
        if (!empty($image)){
            return asset('uploads/settings').'/'.$image;
        }
        return "default.jpg";
    }

    public function setLogoBlackAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'settings');
            $this->attributes['logo_black'] = $imageFields;
        }
    }

    public function getLogoWhiteAttribute($image)
    {
        if (!empty($image)){
            return asset('uploads/settings').'/'.$image;
        }
        return "default.jpg";
    }

    public function setLogoWhiteAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'settings');
            $this->attributes['logo_white'] = $imageFields;
        }
    }


    public function getNameAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->title_ar;
        } else {
            return $this->title_en;
        }
    }

    public function getAddress1Attribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->address1_ar;
        } else {
            return $this->address1_en;
        }
    }

    public function getAddress2Attribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->address2_ar;
        } else {
            return $this->address2_en;
        }
    }
}
