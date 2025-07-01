<?php

namespace App\Helpers;

class Response
{
    public static function success(
        ?string $message = null,
        $data = null,
        array $extra = [],
        int $status = 200
    ) {
        $response = [
            "status" => "success"
        ];

        if ($message !== null) {
            $response["message"] = $message;
        }

        if ($data !== null) {
            $response["data"] = $data;
        }

        $response = array_merge($response, $extra);

        return response()->json($response, $status);
    }


 public static function error(string $message, array|string|null $errors = null, int $status = 400)
{
    $response = [
        "status" => "error",
        "message" => $message
    ];

    if (is_string($errors)) {
        $response["message"] = $errors;
    } elseif (is_array($errors)) {
        $response["errors"] = $errors;
    }

    return response()->json($response, $status);
}

}
