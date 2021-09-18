<?php

namespace Database\Seeders;

use App\Infrastructure\Transfer\Models\Shopkeeper;
use App\Infrastructure\Transfer\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory(
            [
                'name' => 'Guilherme',
                'cpf' => '05069074490'
            ]
        )->create();


        $shopkeeperUser = User::factory()->make(
            [
                'name' => 'Maria',
                'cpf' => '62270257472'
            ]
        );

        Shopkeeper::factory()->make(
            [
                'cnpj' => '123456789101213',
                'tradingName' => 'Coca_Cola'
            ]
        )->setRelation('user', $shopkeeperUser);
    }
}
