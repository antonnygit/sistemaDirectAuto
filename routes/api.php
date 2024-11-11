<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("/token/create", function (Request $request) {
    $token = $request->user()->createToken($request->token_name);

    return ["token" => $token->plainTextToken];
});

require_once "brand.php";
require_once "vehicle.php";
require_once "vehicleStatus.php";
