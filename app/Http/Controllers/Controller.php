<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function respondWithError($message, $status,$data = [])
    {
        $response = [
            'success' => false,
            'message' => $message,
            'data' => $data
        ];
        return response($response, $status);
    }
    protected function respondWithToken($token)
    {
        $data = [
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
        return response()->json(compact('data'));
    }

    protected function respondWithMessage(string $message, $data = [])
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];
        return response($response, 200);
    }
// 'message' => "forgot_password", 'data' => $isUser

}
