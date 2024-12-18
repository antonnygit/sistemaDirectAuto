<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with('brand')->orderBy('created_at', 'desc')->get();
        return VehicleResource::collection($vehicles);
    }

    public function myVehicles()
    {
        $user = auth('sanctum')->user();
        $vehicles = Vehicle::where('user_id', $user->id)->with('brand')->orderBy('created_at', 'desc')->get();
        return VehicleResource::collection($vehicles);
    }

    public function store(VehicleRequest $request)
    {
        $data = $request->validated();
        $user = auth('sanctum')->user();
        $data['user_id'] = $user->id;
        $vehicle = Vehicle::create($data);
        return new VehicleResource($vehicle);
    }

    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        $vehicle->update($request->validated());
        return new VehicleResource($vehicle);
    }

    public function saveImage(Request $request, Vehicle $vehicle)
    {
        try {
            $messages = [
                'required' => 'A imagem é obrigatória',
                'image.image' => 'O arquivo enviado não é uma imagem válida.',
                'image.mimes' => 'A imagem deve ser do tipo: jpg, jpeg ou png.',
                'image.max' => 'A imagem não pode ultrapassar 5MB.'
            ];

            $validator = Validator::make($request->toArray(), [
                'image' => 'required|image|mimes:jpg,jpeg,png|max:5096'
            ], $messages);  

            $validator->validated();

            if ($vehicle->image) Storage::delete($vehicle->image);

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('images', $imageName, 'public');

            $vehicle->update(['image' => $path]);
            $vehicle->save();

            return response()->json([
                'status' => true,
                'message' => "Imagem salva com sucesso."
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'data' => $e->errors()
            ], 400);
        }
    }

    public function show(Vehicle $vehicle)
    {
        $vehicle->with('brand');
        return new VehicleResource($vehicle);
    }

    public function search(Request $request)
    {
        $text = $request->query('search');
        if (strlen($text) == 0)
        {
            $vehicles = Vehicle::with('brand')->get();
            return VehicleResource::collection($vehicles);
        }

        $vehicles = Vehicle::where('name', 'like', '%' . $text . '%')
        ->orWhere('model', 'like', '%' . $text . '%')
        ->with('brand')
        ->get();
        return VehicleResource::collection($vehicles);
    }

    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return response(null, 204);
    }
}
