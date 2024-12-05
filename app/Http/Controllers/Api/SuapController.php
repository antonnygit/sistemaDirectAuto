<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSuapRequest;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Guid\Guid;

class SuapController extends Controller
{
    public function authSuap(StoreSuapRequest $request)
    {
        $client = new Client(['verify' => false]);

        $data = $request->validated();
        $data['password'] = Guid::uuid4()->toString();
        $photo = $data['photo'];

        $user = User::where('email', $data["email"])->first();
        if ($user) {
            $user->tokens()->delete();
        } else {
            if (strlen($photo) > 0) {
                $response = $client->get($photo);
                $imageContent = $response->getBody()->getContents();
                $fileName = time() . '.jpg';
                Storage::disk('public')->put('profile/' . $fileName, $imageContent);
                $data['photo'] = "storage/profile/" . $fileName;
            }
            $user = User::create($data);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Usuário logado com sucesso',
            'token' => $token,
        ]);
    }
}
