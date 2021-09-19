<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Infrastructure\Transfer\Models\EloquentORM\Shopkeeper;
use Infrastructure\Transfer\Models\EloquentORM\User;
use Infrastructure\Transfer\Models\EloquentORM\Wallet;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @return void
     */
    public function run(): void
    {
        $this->createCommonUsers();
        $this->createShopkeeperUser();
    }

    private function createCommonUsers()
    {
        $commonUser = User::factory(
            [
                'name' => 'Guilherme',
                'cpf' => '00000000001'
            ]
        )->create();

        Wallet::factory(
            [
                'user_id' => $commonUser->id,
                'balance' => 10000
            ]
        )->create();

        $commonUser2 = User::factory(
            [
                'name' => 'Jhenifer',
                'cpf' => '00000000002'
            ]
        )->create();

        Wallet::factory(
            [
                'user_id' => $commonUser2->id,
                'balance' => 10000
            ]
        )->create();
    }

    private function createShopkeeperUser()
    {
        $shopkeeperUser = User::factory(
            [
                'name' => 'Luana',
                'cpf' => '00000000003'
            ]
        )->create();

        Shopkeeper::factory(
            [
                'cnpj' => '00000000000003',
                'trading_name' => 'P&P',
                'user_id' => $shopkeeperUser->id
            ]
        )->create();

        Wallet::factory(
            [
                'user_id' => $shopkeeperUser->id,
                'balance' => 0
            ]
        )->create();

        $shopkeeperUser2 = User::factory(
            [
                'name' => 'Eder',
                'cpf' => '00000000004'
            ]
        )->create();

        Shopkeeper::factory(
            [
                'cnpj' => '00000000000004',
                'trading_name' => 'Page Fácil',
                'user_id' => $shopkeeperUser2->id
            ]
        )->create();

        Wallet::factory(
            [
                'user_id' => $shopkeeperUser2->id,
                'balance' => 0
            ]
        )->create();
    }
}
