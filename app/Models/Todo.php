<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        "content",
        "expiry",
        "user_id"
    ];

    protected $dates = [
        "expiry",
    ];

    public function getFormatExpiryAttribute(){
        // return now()->diffInMinutes($this->expiry) . " phút trước";
        return $this->expiry->format("H:i m-d-Y");

    }

    public function getFormatCreatedAttribute()
    {
        return $this->created_at->format("H:i m-d-Y");
    }

    public function getFormatUpdatedAttribute()
    {
        return $this->updated_at->format("H:i m-d-Y");
    }
}
