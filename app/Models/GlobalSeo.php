<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSeo extends Model
{
    use HasFactory;
    protected $fillable = [
        'keywords','description','author','visits','site_map_link','is_google','google_analytics'
        ];
}
