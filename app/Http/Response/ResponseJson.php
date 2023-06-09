<?php

namespace App\Http\Response;

trait ResponseJson {

    protected function response_json($data , int $code, string $message = null)
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data
        ]);
    }
}
