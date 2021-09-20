<?php

namespace Tests\Feature;

use Application\Http\Controllers\TransactionController;
use Application\Http\Requests\StoreTransactionRequest;
use Domain\Transfer\Exceptions\BusinessExceptions\InsufficientWalletBalanceException;
use Domain\Transfer\Exceptions\BusinessExceptions\SameUserReceivingAndPayingException;
use Domain\Transfer\Exceptions\BusinessExceptions\ShopkeppersCannotSendMoneyException;
use Domain\Transfer\Exceptions\BusinessExceptions\TransactionValueInvalidException;
use Domain\Transfer\Exceptions\UserNotFoundException;
use Illuminate\Support\Facades\DB;
use Illuminate\Testing\TestResponse;
use Infrastructure\Transfer\Models\EloquentORM\Shopkeeper;
use Infrastructure\Transfer\Models\EloquentORM\User;
use Infrastructure\Transfer\Models\EloquentORM\Wallet;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    const VALID_CNPJ_1 = '10101010101010';
    const VALID_CNPJ_2 = '10101010101010';
    const VALID_CPF_1 = '10101010101';
    const VALID_CPF_2 = '20202020202';
    const VALID_CPF_3 = '30303030303';
    const VALID_CPF_4 = '40404040404';

    /** @test */
    public function error_user_is_not_found(): void
    {
        $response = $this->makeTransaction(self::VALID_CPF_1, self::VALID_CNPJ_1, 100);

        $responseShortMessage = data_get($this->getJsonFromResponse($response), 'shortMessage');
        $responseMessage = data_get($this->getJsonFromResponse($response), 'description');

        $response->assertStatus(404);

        $key = 'CPF';
        $value = self::VALID_CPF_1;

        $this->assertEquals("Usuário de $key:$value não encontrado", $responseMessage);
        $this->assertEquals(UserNotFoundException::SHORT_MESSAGE, $responseShortMessage);
    }

    /** @test */
    public function error_same_to_user_and_from_user(): void
    {
        DB::beginTransaction();

        $commonUser = $this->createCommonUser(self::VALID_CPF_1, 100);

        $response = $this->makeTransaction($commonUser->cpf, $commonUser->cpf, 100);

        $responseMessage = data_get($this->getJsonFromResponse($response), 'shortMessage');

        $response->assertStatus(422);

        $this->assertEquals(SameUserReceivingAndPayingException::SHORT_MESSAGE, $responseMessage);

        DB::rollBack();
    }

    /** @test */
    public function error_shopkeepers_by_cnpj_to_user(): void
    {
        $shopkeepersToUsersResponse = $this->makeTransaction(self::VALID_CNPJ_1, self::VALID_CPF_1, 100);

        $fromUserErrorMessage = data_get($this->getJsonFromResponse($shopkeepersToUsersResponse), 'errors.from_user.0');

        $shopkeepersToUsersResponse->assertStatus(400);

        $this->assertEquals(StoreTransactionRequest::FROM_USER_SHOUD_BE_CPF_MESSAGE, $fromUserErrorMessage);
    }

    /** @test */
    public function error_shopkeepers_by_cpf_to_user(): void
    {
        DB::beginTransaction();

        $commonUser = $this->createCommonUser(self::VALID_CPF_1, 100);
        $shopkeeper = $this->createShopkeeperUser(self::VALID_CPF_2, self::VALID_CNPJ_2);

        $response = $this->makeTransaction($shopkeeper->cpf, $commonUser->cpf, 100);

        $responseMessage = data_get($this->getJsonFromResponse($response), 'shortMessage');

        $response->assertStatus(422);

        $this->assertEquals(ShopkeppersCannotSendMoneyException::SHORT_MESSAGE, $responseMessage);

        DB::rollBack();
    }

    /** @test */
    public function error_invalid_value_transaction(): void
    {
        DB::beginTransaction();

        $commonUser = $this->createCommonUser(self::VALID_CPF_1, 100);
        $shopkeeper = $this->createShopkeeperUser(self::VALID_CPF_2, self::VALID_CNPJ_2);

        $response = $this->makeTransaction($commonUser->cpf, $shopkeeper->cpf, 0);

        $responseMessage = data_get($this->getJsonFromResponse($response), 'shortMessage');

        $response->assertStatus(422);

        $this->assertEquals(TransactionValueInvalidException::SHORT_MESSAGE, $responseMessage);

        DB::rollBack();
    }

    /** @test */
    public function error_user_without_balance()
    {
        DB::beginTransaction();

        $commonUser = $this->createCommonUser(self::VALID_CPF_1);
        $shopkeeper = $this->createShopkeeperUser(self::VALID_CPF_2, self::VALID_CNPJ_2);

        $response = $this->makeTransaction($commonUser->cpf, $shopkeeper->cpf, 100);

        $responseMessage = data_get($this->getJsonFromResponse($response), 'shortMessage');

        $response->assertStatus(422);

        $this->assertEquals(InsufficientWalletBalanceException::SHORT_MESSAGE, $responseMessage);

        DB::rollBack();
    }

    /** @test */
    public function success_valid_users_valid()
    {
        DB::beginTransaction();

        $commonUser = $this->createCommonUser(self::VALID_CPF_1, 1000);
        $shopkeeper = $this->createShopkeeperUser(self::VALID_CPF_2, self::VALID_CNPJ_2);
        $response = $this->makeTransaction($commonUser->cpf, $shopkeeper->cpf, 100);
        $responseMessage = data_get($this->getJsonFromResponse($response), 'message');

        $response->assertStatus(200);

        $this->assertEquals(900, $commonUser->wallet->balance);
        $this->assertEquals(100, $shopkeeper->wallet->balance);
        $this->assertEquals(TransactionController::SUCCESS_TRANSACTION_MESSAGE, $responseMessage);

        DB::rollBack();
    }


    private function createCommonUser(string $cpf, float $balance = 0): User
    {
        $user = User::factory(
            [
                'name' => 'Usuario',
                'cpf' => $cpf
            ]
        )->create();

        Wallet::factory(
            [
                'user_id' => $user->id,
                'balance' => $balance
            ]
        )->create();

        return $user;
    }

    private function createShopkeeperUser(string $cpf, string $cnpj): User
    {
        $user = User::factory(
            [
                'name' => 'Logista',
                'cpf' => $cpf
            ]
        )->create();

        Shopkeeper::factory(
            [
                'cnpj' => $cnpj,
                'trading_name' => 'Empresa',
                'user_id' => $user->id
            ]
        )->create();

        Wallet::factory(
            [
                'user_id' => $user->id,
                'balance' => 0
            ]
        )->create();

        return $user;
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
