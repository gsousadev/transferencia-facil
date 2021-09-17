<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Models\Transaction;
use App\Domain\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

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


    public function find(array $filters = []): Collection
    {
        $initialDate = data_get($filters, 'initial_date');
        $finalDate = data_get($filters, 'final_date');

        if ($initialDate === null || $finalDate === null) {
            return Transaction::all();
        }

        $initialDate = Carbon::parse($initialDate);
        $finalDate = Carbon::parse($finalDate);

        return Transaction::query()
            ->where('created_at', '>=', $initialDate->toDateTimeString())
            ->where('updated_at', '<=', $finalDate->toDateTimeString())
            ->with(['from','to'])
            ->get();

    }
}
