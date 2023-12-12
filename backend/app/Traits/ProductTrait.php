<?php
namespace App\Traits;

trait ProductTrait
{
    public static function successfulResponse($status = 'success', $message, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }
    public static function failedResponse($status = 'error', $message)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
        ]);
    }
}