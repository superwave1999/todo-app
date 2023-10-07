<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LoginResponse implements Responsable
{
    public function __construct(
        public readonly Authenticatable $data,
    ) {}

    public function toResponse($request): JsonResponse
    {
        $user = [
            'id' => $this->data->id,
            'name' => $this->data->name,
            'email' => $this->data->email
        ];
        return new JsonResponse(
            data: $user,
            status: Response::HTTP_OK,
        );
    }
}
