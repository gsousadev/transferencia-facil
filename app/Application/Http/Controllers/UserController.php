<?php

declare(strict_types=1);

namespace Application\Http\Controllers;

use Domain\Transfer\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function find(Request $request): JsonResponse
    {
        return $this->response($this->userService->find($request->only('name', 'cpf', 'email')));
    }
}
