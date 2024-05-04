<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Coupons;
use App\Models\Favourite;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function successResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function errorResponse($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'error' => $error,
            'code' => $code,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    /**
     * Send Invalid response for invalid data of api.
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorInvalidResponse()
    {
        $response = [
            'success' => false,
            'error' => "Invalid Data.",
            'code' => 422,
        ];
        return response()->json($response, 422);
    }
}
