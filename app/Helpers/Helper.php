<?php

function productImagePath($image_name)
{
    return public_path('images/products/' . $image_name);
}


function send_msg($msg, $status, $code = 404)
{
    $response = [
        'status' => $status,
        'message' => $msg,
    ];
    return response()->json($response, $code);
}


function catch_error($getMsg, $code = 500)
{
    $res = [
        'status' => false,
        'message' => $getMsg,
    ];
    return response()->json($res, $code);
}

function send_err($errName, $getMsg, $code = 422)
{
    $res = [
        'errors' => [
            "$errName" => $getMsg
        ]
    ];

    return response()->json($res, $code);
}
