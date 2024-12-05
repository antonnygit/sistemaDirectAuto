<?php

use App\Http\Controllers\Api\VehicleController;
use App\Http\Middleware\AuthApi;
use Illuminate\Support\Facades\Route;

Route::get("/api/v1/vehicle/search", [VehicleController::class, "search"])->middleware(AuthApi::class)->name("vehicle.search");

require_once "auth.php";
require_once "brand.php";
require_once "vehicle.php";
require_once "vehicleStatus.php";