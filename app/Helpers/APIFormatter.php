<?php
    namespace App\Helpers;

    class APIFormatter{
        protected static $response = [
            'status' => null,
            'message' => null,
            'data' => null,
        ];

        public static function createAPI($code = null, $message = null, $data = null){
            self::$response['status'] = $code;
            self::$response['message'] = $message;
            self::$response['data'] = $data;

            return response()->json(self::$response, self::$response['status']);
        }
    }