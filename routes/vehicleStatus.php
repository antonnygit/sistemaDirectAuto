<?php

use App\Http\Controllers\Api\VehicleStatusController;
use Illuminate\Support\Facades\Route;

Route::get("/api/v1/vehicleStatus", [VehicleStatusController::class, "index"])->name("vehicle.status.index");
Route::post("/api/v1/vehicleStatus", [VehicleStatusController::class, "store"])->name("vehicle.status.store");
Route::put("/api/v1/vehicleStatus/{status}", [VehicleStatusController::class, "update"])->name("vehicle.status.update");
Route::delete("/api/v1/vehicleStatus/{status}", [VehicleStatusController::class, "destroy"])->name("vehicle.status.destroy");