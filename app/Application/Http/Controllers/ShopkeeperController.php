<?php

declare(strict_types=1);

namespace Application\Http\Controllers;

use Domain\Transfer\Services\ShopkeeperService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopkeeperController extends Controller
{
    private $shopkeeperService;

    public function __construct(ShopkeeperService $shopkeeperService)
    {
        $this->shopkeeperService = $shopkeeperService;
    }

    public function find(Request $request): JsonResponse
    {
        return $this->response($this->shopkeeperService->find($request->only('cnpj', 'trading_name')));
    }
}
