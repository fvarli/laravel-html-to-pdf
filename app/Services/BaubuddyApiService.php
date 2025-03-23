<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BaubuddyApiService
{
    private string $apiUrl;
    private string $loginUrl;
    private string $apiAuthorization;
    private string $apiUsername;
    private string $apiPassword;

    public function __construct()
    {
        $this->apiUrl  = config('services.baubuddy.api_url');
        $this->loginUrl  = config('services.baubuddy.api_login_url');
        $this->apiAuthorization  = config('services.baubuddy.api_authorization');
        $this->apiUsername  = config('services.baubuddy.api_username');
        $this->apiPassword  = config('services.baubuddy.api_password');
    }

    public function getAccessToken()
    {
        $response = Http::withHeaders([
            "Authorization" => "Basic $this->apiAuthorization",
            "Content-Type" => "application/json"
        ])->post($this->loginUrl, [
            "username" => $this->apiUsername,
            "password" => $this->apiPassword
        ]);

        if ($response->failed()) {
            return null;
        }

        return $response->json()['oauth']['access_token'] ?? null;
    }

    public function getTasks()
    {
        $token = $this->getAccessToken();
        if (!$token) {
            return null;
        }

        $response = Http::withHeaders([
            "Authorization" => "Bearer $token"
        ])->get($this->apiUrl);

        return $response->json();
    }
}
