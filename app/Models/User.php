<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'role',
        'socialite',
        'is_active',
    ];

    public function getImageUrlAttribute()
    {
        return Storage::exists($this->image) ? ("storage/" . $this->image) : "assets/img/default-user.png";
    }

    public function getRoleNameAttribute()
    {
        if ($this->role == 1) {
            return "Admin";
        }
        return "User";
    }

    public function setNameAttribute($value)
    {
        $name = [];
        $array_name = array_filter(explode(" ", $value), function ($value) {
            if ($value != "") {
                return $value;
            }
        });
        foreach ($array_name as $item) {
            $name[] = mb_convert_case((trim($item)), MB_CASE_TITLE, 'UTF-8');
        }
        $this->attributes['name'] = implode(" ", $name);
    }

    public function setPasswordAttribute($value)
    {
        if($value != null){
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function setImageAttribute($value)
    {
        $path = $value->store(Auth::user()->email . rand(1,100));
        $this->attributes['image'] = $path;
    }

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
