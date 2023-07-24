<?php

namespace App\Helpers;

use App\Models\Deadline;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;

function cacheDatabaseDeadlines($start, $end, $time = null)
{
    // $name = "deadlines";
    // if (cache()->has($name)) {
    //     return cache($name);
    // }
    // if (is_null($time)) {
    //     $time = now()->addHours(1);
    // }
    $data = Deadline::whereDate("deadline", ">=", $start)->whereDate("deadline", "<=", $end)->get();
    // cache([$name => $data], $time);
    return $data;
}
