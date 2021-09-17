<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Domain\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function store(StoreTransactionRequest $request)
    {
        $this->transactionService->store($request->only(['value', 'from_user', 'to_user']));

        return $this->response([], 'Transação efetuada com sucesso!');
    }

    public function find(Request $request)
    {
        $transactions = $this->transactionService->find($request->only(['value', 'from_user', 'to_user']));

        return $this->response($transactions->toArray());
    }
}
