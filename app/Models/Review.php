<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'user_id',
        'rate', 'comment',
        'viewed',
    ];

    public function Product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }

    public function User()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
