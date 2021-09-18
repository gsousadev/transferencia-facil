<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories\EloquentORM;

use Domain\Transfer\Entities\ShopkeeperInterface;
use Domain\Transfer\Entities\TransactionInterface;
use Domain\Transfer\Repositories\TransactionRepositoryInterface;
use Infrastructure\Transfer\Models\Transaction;
use Carbon\Carbon;

class TransactionORMRepository extends AbstractORMRepository implements TransactionRepositoryInterface
{
    public function store(TransactionInterface $transaction): bool
    {
        $transactionORM = new Transaction();

        $transactionORM->fill([
            'value' => $transaction->getValue()
        ]);

        $transactionORM->setRelation('from', $transactionORM->getFromUser());

        $transactionORM->setRelation('to', $transactionORM->getToUser());

        return $transactionORM->save();
    }


    public function find(array $filters = []): array
    {
        $initialDate = data_get($filters, 'initial_date');
        $finalDate = data_get($filters, 'final_date');

        if ($initialDate === null || $finalDate === null) {
            return Transaction::all()->toArray();
        }

        $initialDate = Carbon::parse($initialDate);
        $finalDate = Carbon::parse($finalDate);

        return Transaction::query()
            ->where('created_at', '>=', $initialDate->toDateTimeString())
            ->where('updated_at', '<=', $finalDate->toDateTimeString())
            ->with(['from','to'])
            ->get()
            ->toArray();
    }

    public function getById(int $id): ?TransactionInterface
    {
        $transaction = Transaction::query()->find($id);

        return $transaction instanceof TransactionInterface ? $transaction : null;
    }
}
