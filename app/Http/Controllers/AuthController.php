<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Responses\LoginResponse;
use App\Service\AuthService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $login): \Illuminate\Http\Response|LoginResponse
    {
        $user = AuthService::login($login);
        if ($user) {
            return new LoginResponse($user);
        } else {
            return response()->noContent(Response::HTTP_UNAUTHORIZED);
        }
    }
}
