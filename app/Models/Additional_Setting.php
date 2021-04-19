<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Additional_Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'type', 'value_ar', 'value_en',
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
}
