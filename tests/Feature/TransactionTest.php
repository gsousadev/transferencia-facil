<?php

namespace Tests\Feature;

use Application\Http\Controllers\TransactionController;
use Application\Http\Requests\StoreTransactionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;
use Infrastructure\Transfer\Enumerator\TransactionEnumerator;
use Infrastructure\Transfer\Models\EloquentORM\Shopkeeper;
use Infrastructure\Transfer\Models\EloquentORM\User;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    const VALID_CNPJ = '12345678910111';
    const VALID_CPF = '00000000868';
    const VALID_CPF_2 = '00000001597';

    /** @test */
    public function transaction_invalid_from_shopkeepers_to_user(): void
    {
        $shopkeepersToUsersResponse = $this->makeTransaction(self::VALID_CNPJ, self::VALID_CPF, 100);

        $fromUserErrorMessage = data_get($this->getJsonFromResponse($shopkeepersToUsersResponse), 'errors.from_user.0');

        $shopkeepersToUsersResponse->assertStatus(400);

        $this->assertEquals(StoreTransactionRequest::FROM_USER_SHOUD_BE_CPF_MESSAGE, $fromUserErrorMessage);
    }

    /** @test */
    public function transaction_where_from_user_is_not_found(): void
    {
        $response = $this->makeTransaction(self::VALID_CPF, self::VALID_CNPJ, 100);

        $responseMessage = data_get($this->getJsonFromResponse($response), 'message');

        $response->assertStatus(404);

        $this->assertEquals('Usuário de CPF:' . self::VALID_CPF . ' não encontrado', $responseMessage);
    }

    /** @test */
    public function transaction_with_valid_users()
    {
        DB::beginTransaction();

        [$commonUser, $shopkeeper] = $this->createCommonUserAndShopkeeperUser();

        $response = $this->makeTransaction($commonUser->cpf, $shopkeeper->cpf, 100);

        $responseMessage = data_get($this->getJsonFromResponse($response), 'message');

        $response->assertStatus(200);

        $this->assertEquals(TransactionController::SUCCESS_TRANSACTION_MESSAGE, $responseMessage);

        DB::rollBack();
    }

    private function createCommonUserAndShopkeeperUser(): array
    {
        $commonUser = User::factory()
            ->create(
                [
                    'name' => 'Guilherme',
                    'cpf' => self::VALID_CPF
                ]
            );

        $shopkeeperUser = User::factory()
            ->create(
                [
                    'name' => 'Maria',
                    'cpf' => self::VALID_CPF_2
                ]
            );

        Shopkeeper::factory()
            ->for($shopkeeperUser)
            ->create(
                [
                    'cnpj' => self::VALID_CNPJ,
                    'trading_name' => 'Coca_Cola'
                ]
            );

        return [$commonUser, $shopkeeperUser];
    }


    private function makeTransaction(string $from, string $to, float $value)
    {
        return $this->post(
            '/api/transaction/',
            [
                "value" => $value,
                "from_user" => $from,
                "to_user" => $to
            ]
        );
    }

    private function getJsonFromResponse(TestResponse $response)
    {
        return json_decode($response->getContent(), true);
    }
}
