<?php

use App\Http\Controllers\Api\VehicleController;
use App\Http\Middleware\AuthApi;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(AuthApi::class)->group(function(){
    Route::get("/api/v1/vehicle", [VehicleController::class, "index"])->name("vehicle.index");
    Route::get("/api/v1/vehicle/{vehicle}", [VehicleController::class, "show"])->name("vehicle.show");
    Route::post("/api/v1/vehicle", [VehicleController::class, "store"])->name("vehicle.store");
    Route::put("/api/v1/vehicle", [VehicleController::class, "update"])->name("vehicle.update");
    Route::delete("/api/v1/vehicle/{vehicle}", [VehicleController::class, "destroy"])->name("vehicle.destroy");
    Route::post("/api/v1/vehicle/image/{vehicle}", [VehicleController::class, "saveImage"])->name("vehicle.image");
});