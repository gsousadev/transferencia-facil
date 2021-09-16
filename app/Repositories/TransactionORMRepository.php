<?php


namespace App\Repositories;


use App\Models\Transaction;
use App\Models\User;

class TransactionORMRepository implements TransactionRepositoryInterface
{
    public function store(User $fromUser, User $toUser, float $value = 0): bool
    {
        $transaction = new Transaction();

        $transaction->fill([
            'value' => $value
        ]);

        $transaction->setRelation('from', $fromUser);

        $transaction->setRelation('to', $toUser);

        return $transaction->save();
    }


}
