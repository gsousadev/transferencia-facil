<?php

declare(strict_types=1);

namespace Application\Http\Controllers;

use Application\Http\Requests\StoreTransactionRequest;
use Domain\Transfer\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public const SUCCESS_TRANSACTION_MESSAGE = 'Transação efetuada com sucesso!';

    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function store(StoreTransactionRequest $request): JsonResponse
    {
        $transaction = $this->transactionService->process($request->only(['value', 'from_user', 'to_user']));

        return $this->response($transaction, self::SUCCESS_TRANSACTION_MESSAGE);
    }

    public function find(Request $request): JsonResponse
    {
        $transactions = $this->transactionService->find($request->only(['value', 'from_user', 'to_user']));

        return $this->response($transactions);
    }
}
