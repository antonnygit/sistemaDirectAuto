<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SuapController extends Controller
{
    public function getAccessToken()
    {
        $client = new Client();

        // $response = $client->post('https://suap.ifrn.com.br/oauth/token', [
        //     'form_params' => [
        //         'grant_type' => 'client_credentials',  // ou 'authorization_code', conforme o fluxo
        //         'client_id' => env('SUAP_CLIENT_ID'),
        //         'client_secret' => env('SUAP_CLIENT_SECRET'),
        //         'scope' => 'read write', // ajuste conforme necessário
        //     ]
        // ]);

        $response = $client->post('https://suap.ifrn.com.br/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',  // ou 'authorization_code', conforme o fluxo
                'client_id' => env('SUAP_ID'),
                'client_secret' => env('SUAP_SECRET'),
                'scope' => 'read write', // ajuste conforme necessário
            ]
        ]);

        $body = json_decode($response->getBody(), true);
        return $body['access_token'];
    }

    public function getUserData($accessToken)
    {
        $client = new Client();

        $response = $client->get('https://suap.ifrn.com.br/api/eu/', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
        ]);

        $userData = json_decode($response->getBody(), true);
        return $userData;
    }

}
