<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'content',
        'user_id',
        'post_id',
    ];

    public function getFormatDateAttribute()
    {
        if($this->updated_at != $this->created_at){
            return $this->created_at->format("M D 'y h:i") . " - update " . $this->updated_at->diffForHumans();
        }
        return $this->created_at->diffForHumans();
    }

    
    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
