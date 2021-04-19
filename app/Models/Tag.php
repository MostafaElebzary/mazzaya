<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'title_ar', 'title_en',
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

}
