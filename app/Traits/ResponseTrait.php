<?php

namespace App\Traits;

trait ResponseTrait
{
    function successResponse($data = [], $message = "success", $status_code = 200)
    {
        return response()->json([
            "status_code" => $status_code,
            "data" => $data,
            "message" => $message
        ], $status_code);
    }

    function errorResponse($data = [], $message, $status_code = 400)
    {
        return response()->json([
            "status_code" => $status_code,
            "data" => $data,
            "message" => $message
        ], $status_code);
    }
}
