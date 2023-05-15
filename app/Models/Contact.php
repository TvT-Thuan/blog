<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'subject',
        'is_seen',
        'message',
        'is_seen',
    ];

    public function getSubjectLimitAttribute()
    {
        return Str::limit($this->subject, 20);
    }
    public function getUpdatedAtColumn()
    {
        return null;
    }
}
