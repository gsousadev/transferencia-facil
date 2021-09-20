<?php

namespace Tests\Unit;

use Infrastructure\Transfer\Models\EloquentORM\Shopkeeper;
use Infrastructure\Transfer\Models\EloquentORM\Transaction;
use Infrastructure\Transfer\Models\EloquentORM\User;
use Infrastructure\Transfer\Models\EloquentORM\Wallet;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    /** @test */
    public function check_user_columns_is_correct(): void
    {
        $user = new User();

        $expectedUserFillable = ['name', 'email', 'cpf', 'password'];

        $diff = array_diff($expectedUserFillable, $user->getFillable());

        $this->assertEquals(0, count($diff));
    }

    /** @test */
    public function check_shopkeepers_columns_is_correct(): void
    {
        $shopkeeper = (new Shopkeeper());

        $expectedUserFillable = [
            'cnpj',
            'trading_name'
        ];

        $diff = array_diff($expectedUserFillable, $shopkeeper->getFillable());

        $this->assertEquals(0, count($diff));
    }

    /** @test */
    public function check_wallet_columns_is_correct(): void
    {
        $wallet = (new Wallet());

        $expectedUserFillable = ['balance'];

        $diff = array_diff($expectedUserFillable, $wallet->getFillable());

        $this->assertEquals(0, count($diff));
    }

    /** @test */
    public function check_transaction_columns_is_correct(): void
    {
        $transaction = (new Transaction());

        $expectedUserFillable =
            [
                'value',
                'status',
                'from_user_id',
                'to_user_id',
                'reason_cancellation'
            ];

        $diff = array_diff($expectedUserFillable, $transaction->getFillable());

        $this->assertEquals(0, count($diff));
    }
}
