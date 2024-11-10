<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleStatusRequest;
use App\Http\Resources\VehicleStatusResource;
use App\Models\VehicleStatus;

class VehicleStatusController extends Controller
{
    public function index()
    {
        $status = VehicleStatus::all();
        return VehicleStatusResource::collection($status);
    }

    public function store(VehicleStatusRequest $request)
    {
        $status = VehicleStatus::create($request->validated());
        return new VehicleStatusResource($status);
    }

    public function update(VehicleStatusRequest $request, VehicleStatus $status)
    {
        $status->update($request->validated());
        return new VehicleStatusResource($status);
    }

    public function destroy(VehicleStatus $status)
    {
        $status->delete();
        return response(null, 204);
    }
}
