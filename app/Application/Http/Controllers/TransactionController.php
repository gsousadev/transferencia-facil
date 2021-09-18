<?php

declare(strict_types=1);

namespace Application\Http\Controllers;

use Application\Http\Requests\StoreTransactionRequest;
use Domain\Transfer\Services\TransactionService;
use Infrastructure\Transfer\Enumerator\TransactionEnumerator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function store(StoreTransactionRequest $request): JsonResponse
    {
        $this->transactionService->store($request->only(['value', 'from_user', 'to_user']));

        return $this->response([], TransactionEnumerator::SUCCESS_TRANSACTION_MESSAGE);
    }

    public function find(Request $request): JsonResponse
    {
        $transactions = $this->transactionService->find($request->only(['value', 'from_user', 'to_user']));

        return $this->response($transactions);
    }
}
