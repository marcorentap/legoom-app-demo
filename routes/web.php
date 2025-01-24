<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/redirect', function () {
    $query = http_build_query([
        'client_id' => '9e0991db-804d-4037-808a-ce451ac6d3e2',
        'redirect_uri' => url('/callback'),
        'response_type' => 'code',
        'scope' => 'write-personal-info read-membership-info',
        'prompt' => "consent"
    ]);

    return redirect('http://box-wsl/oauth/authorize?' . $query);
});

Route::get('/callback', function (Request $request) {
    # Get access token
    $response = Http::asForm()->post('http://box-wsl/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => '9e0991db-804d-4037-808a-ce451ac6d3e2',
        'client_secret' => 'WZcLirYopHkQsAdGTaalkad62YGfZNfx0YWShfKZ',
        'redirect_uri' => url('/callback'),
        'code' => $request->code,
    ]);

    if ($response->status() == 200) {
        # Get user name
        $accessToken = $response->json("access_token");

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get('http://box-wsl/api/user');


        $username = $response->json("name");
        $email = $response->json("email");
        return Inertia::render('Callback', [
            "username" => $username,
            "email" => $email,
        ]);
    } else {
        return $response->json();
    }
});
