<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Service\AuthService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $login): UserResource|Response
    {
        $user = AuthService::login($login);
        if ($user) {
            return new UserResource($user);
        } else {
            return response()->noContent(Response::HTTP_UNAUTHORIZED);
        }
    }
}
