<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return BrandResource::collection($brands);
    }

    public function store(BrandRequest $request)
    {
        $brand = Brand::create($request->validated());
        return new BrandResource($brand);
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $brand->update($request->validated());
        return new BrandResource($brand);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return response(null, 204);
    }
}
