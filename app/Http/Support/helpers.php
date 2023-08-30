<?php

if (!function_exists('paginateResponse')) {
    function paginateResponse($data, $collection, $code = 200, $message = '', $headers = [])
    {
        $meta = [
            'meta' => [
                'total' => $collection->total(),
                'from' => $collection->firstItem(),
                'to' => $collection->lastItem(),
                'count' => $collection->count(),
                'per_page' => $collection->perPage(),
                'current_page' => $collection->currentPage(),
                'last_page' => $collection->lastPage(),
            ],
        ];


        $response = [
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ] + $meta;

        return response()->json($response, $code, $headers);
    }
}

if (!function_exists('errorResponse')) {
    function errorResponse(mixed $data = null, string $message = '', int $code = 422, array $headers = [])
    {
        $response = [
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $code, $headers);
    }
}

if (!function_exists('successResponse')) {
    function successResponse(mixed $data = null, string $message = '', int $code = 200,  array $headers = [])
    {
        $response = [
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return response()->json($response, $code, $headers);
    }
}
