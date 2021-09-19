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
        $commonUser = User::factory(
            [
                'name' => 'Guilherme',
                'cpf' => '00000000868'
            ]
        )->create();

        Wallet::factory(
            [
                'user_id' => $commonUser->id
            ]
        )->create();

        $shopkeeperUser = User::factory(
            [
                'name' => 'Maria',
                'cpf' => '00000001597'
            ]
        )->create();

        Shopkeeper::factory(
            [
                'cnpj' => '12345678910121',
                'trading_name' => 'Coca_Cola',
                'user_id' => $shopkeeperUser->id
            ]
        )->create();

        Wallet::factory(
            [
                'user_id' => $shopkeeperUser->id
            ]
        )->create();
    }
}
