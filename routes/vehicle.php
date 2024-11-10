<?php

use App\Http\Controllers\Api\VehicleController;
use Illuminate\Support\Facades\Route;

Route::get("/api/v1/vehicle", [VehicleController::class, "index"])->name("vehicle.index");
Route::post("/api/v1/vehicle", [VehicleController::class, "store"])->name("vehicle.store");
Route::put("/api/v1/vehicle/{vehicle}", [VehicleController::class, "update"])->name("vehicle.update");
Route::delete("/api/v1/vehicle/{vehicle}", [VehicleController::class, "destroy"])->name("vehicle.destroy");