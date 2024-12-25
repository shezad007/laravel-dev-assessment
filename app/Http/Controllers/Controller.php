<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    const DEFAULT_ELEMENTS_PER_PAGE = 20;

    public function sendResponse($result = [], $message="") {
        $response = array();
        $response['error'] = false;
        $response['data'] = (empty($result)) ? [] : $result;
        $response['message'] = $message;

        return response()->json((array)$response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 200){
    	$response = [
            'error' => true,
            'message' => $error,
        ];
        $response['data'] = (object) $errorMessages;
        return response()->json($response, $code);
    }
}
