<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'is_active',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function postsPagination(){
        return $this->posts()->paginate(5);
    }

    public function commnents()
    {
        return $this->hasMany(Comment::class);
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
            $name[] = mb_convert_case(($item), MB_CASE_TITLE, 'UTF-8');
        }
        $this->attributes['name'] = implode(" ", $name);
    }

    protected $casts = [
        'is_active' => 'string'
    ];
}
