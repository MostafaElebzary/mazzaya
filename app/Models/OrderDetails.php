<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'product_title_ar', 'product_title_en',
        'product_attributes', 'price', 'quantity'
    ];

    protected $casts = ['product_attributes'=>'array'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    protected $appends = ['product_title'];

    public function getProductTitleAttribute()
    {
        if ($locale = App::currentLocale() == "ar") {
            return $this->product_title_ar;
        } else {
            return $this->product_title_en;
        }
    }
}
