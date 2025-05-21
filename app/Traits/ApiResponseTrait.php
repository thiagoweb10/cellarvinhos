<?php

namespace App\Traits;

trait ApiResponseTrait
{
    protected function successResponse($aData = [], string $message = 'Success', int $statusCode = 200 )
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $aData
        ], $statusCode, [],JSON_UNESCAPED_UNICODE);
    }

    protected function errorResponse(string $message = 'Error', int $statusCode = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $statusCode, [], JSON_UNESCAPED_UNICODE);
    }
}