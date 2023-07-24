<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    use HasFactory;

    protected $fillable = [
        "deadline",
        "todo_id"
    ];

    protected $dates = [
        "deadline",
    ];

    public $timestamps = false;
}
