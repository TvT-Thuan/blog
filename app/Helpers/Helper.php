<?php

namespace App\Helpers;

use App\Models\Category;
use App\Models\Deadline;
use App\Models\Post;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;

function cacheDatabaseDeadlines($start, $end, $time = null)
{
    $name = "deadlines";
    if (cache()->has($name)) {
        return cache($name);
    }
    if (is_null($time)) {
        $time = now()->addHours(1);
    }
    $data = Deadline::whereDate("deadline", ">=", $start)->whereDate("deadline", "<=", $end)->get();
    cache([$name => $data], $time);
    return $data;
}

function cacheDatabase(string $name, $fil = "*", $time = null)
{
    if (cache()->has($name)) {
        return cache($name);
    }
    if (is_null($time)) {
        $time = now()->addHours(5);
    }
    switch ($name) {
        case 'categories':
            $data = Category::where("is_active", 1)->get($fil);
            break;

        case 'posts_latest':
            $data = Post::where("is_active", 1)->whereRelation("category", "is_active", 1)->latest()->limit(5)->with(["user", "category"])->get();
            break;

        case 'posts_paginate':
            $data = Post::where("is_active", 1)->whereRelation("category", "is_active", 1)->with(["user", "category"])->latest()->paginate(5);
            break;

        case 'posts':
            $data = Post::where("is_active", 1)->whereRelation("category", "is_active", 1)->with(["user", "category"])->get();
            break;

        case 'posts_popular':
            $data = Post::where("is_active", 1)->whereRelation("category", "is_active", 1)->with(["user", "category"])->orderByDesc("view")->limit(5)->get();
            break;

        case 'posts_trending':
            $data = Post::query()->where("is_active", 1)->whereRelation("category", "is_active", 1)->with(["user", "category"])->latest()->orderByDesc("view")->limit(5)->get();
            break;
        case 'sliders':
            $data = Post::where("is_check", 1)->get();
            break;
    }
    cache([$name => $data], $time);
    return $data;
}
