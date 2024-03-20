<?php

namespace App\Helpers;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Format response.
 */
class ResponseFormatter
{
    /**
     * API Response
     *
     * @var array
     */
    protected static $response = [
        'meta' => [
            'code' => 200,
            'status' => 'success',
            'message' => null,
        ],
        'data' => null,
    ];

    /**
     * Give success response.
     */
    public static function success($data = [], $message = 'Successful', $errorCode = 0)
    {
        if( $data instanceof AnonymousResourceCollection )   #For using instances of app\Http\Resources directly return the data as pagination already done
        {
            self::$response['meta']['message'] = $message;
            self::$response['data'] = $data->resource;
            self::$response['error_code'] = $errorCode;
            return response()->json(self::$response, self::$response['meta']['code']);
        }

        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;
        self::$response['error_code'] = $errorCode;
        return response()->json(self::$response, self::$response['meta']['code']);
    }

    /**
     * Give error response.
     */
    public static function error($data = [], $message = 'Error', $code = 400, $errorCode = 1404)
    {
        self::$response['meta']['status'] = 'error';
        self::$response['meta']['code'] = $code;
        self::$response['meta']['message'] = $message;
        self::$response['data'] = $data;
        self::$response['error_code'] = $errorCode;
        return response()->json(self::$response, self::$response['meta']['code']);
    }
}