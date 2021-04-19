<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;
    protected $fillable =[
        'product_id','tag_id'
    ];

    public function tags()
    {

        return $this->belongsTo(Tag::class, 'tag_id');
    }
    public function products()
    {

        return $this->belongsTo(Product::class, 'product_id');
    }

}
