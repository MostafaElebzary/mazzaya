<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory ,Notifiable;
    protected $fillable = [
        'name', 'email', 'phone', 'password', 'is_active', 'image',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getImageAttribute($image)
    {
        if (!empty($image)){
            return asset('uploads/admins').'/'.$image;
        }
        return "default.jpg";
    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'admins');
            $this->attributes['image'] = $imageFields;
        }
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password)){
            $this->attributes['password'] = Hash::make($password);
        }
    }
}
