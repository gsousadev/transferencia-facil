<?php

namespace Tests\Unit;

use App\Models\Shopkeepers;
use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /** @test */
    public function check_user_columns_is_correct(): void
    {
        $user = new User();

        $expectedUserFillable = ['name','email', 'cpf', 'password'];

        $diff = array_diff($expectedUserFillable, $user->getFillable());

        $this->assertEquals(0, count($diff));
    }
    /** @test */

    public function check_shopkeepers_columns_is_correct(): void
    {
        $shopkeeper = (new Shopkeepers());

        $expectedUserFillable = ['cnpj', 'trading_name'];

        $diff = array_diff($expectedUserFillable, $shopkeeper->getFillable());

        $this->assertEquals(0, count($diff));
    }
}
