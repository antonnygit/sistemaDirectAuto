<?php

use App\Http\Controllers\Api\BrandController;
use Illuminate\Support\Facades\Route;

Route::get("/api/v1/brand", [BrandController::class, "index"])->name("brand.index");
Route::post("/api/v1/brand", [BrandController::class, "store"])->name("brand.store");
Route::put("/api/v1/brand/{brand}", [BrandController::class, "update"])->name("brand.update");
Route::delete("/api/v1/brand/{brand}", [BrandController::class, "destroy"])->name("brand.destroy");