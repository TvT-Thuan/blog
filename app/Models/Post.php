<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'view',
        'user_id',
        'category_id',
        'is_check',
        'is_active',
    ];

    public function setImageAttribute($value)
    {
        $path = $value->store(Auth::user()->email);
        $this->attributes['image'] = $path;
    }

    public function setTitleAttribute($value)
    {
        $array_name = array_filter(explode(" ", $value), function ($value) {
            if ($value != "") {
                return $value;
            }
        });
        $this->attributes['title'] = mb_convert_case(implode(" ", $array_name), MB_CASE_TITLE, 'UTF-8');
    }

    public function getImageUrlAttribute()
    {
        return Storage::exists($this->image) ? ("storage/" . $this->image) : "assets/img/default-user.png";
    }

    public function getFormatDateAttribute()
    {
        return $this->created_at->format("d/m/Y h:i") . " - " . $this->created_at->diffForHumans();
    }

    public function getContentLimitAttribute()
    {
        return Str::words(html_entity_decode(strip_tags($this->content)), 40, "...");
    }

    public function getContentLimit2Attribute()
    {
        return Str::words(html_entity_decode(strip_tags($this->content)), 20, "...");
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
