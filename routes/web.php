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
        'client_id' => env('LEGOOM_CLIENT_ID'),
        'redirect_uri' => url('/callback'),
        'response_type' => 'code',
        'scope' => 'read-account',
        'prompt' => "consent"
    ]);

    return redirect(env('LEGOOM_ID_URL') . '/oauth/authorize?' . $query);
});

Route::get('/callback', function (Request $request) {
    # Get access token
    $response = Http::asForm()->post(env('LEGOOM_ID_URL') . '/oauth/token', [
        'grant_type' => 'authorization_code',
        'client_id' => env('LEGOOM_CLIENT_ID'),
        'client_secret' => env('LEGOOM_CLIENT_SECRET'),
        'redirect_uri' => url('/callback'),
        'code' => $request->code,
    ]);


    if ($response->status() == 200) {
        # Get user name
        $accessToken = $response->json("access_token");

        $user = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get(env('LEGOOM_ID_URL') . '/api/user');

        return Inertia::render('Callback', ['user' => $user->json()]);
    } else {
        return $response->json();
    }
});
