<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test  */
    public function transaction_from_shopkeepers_to_user(): void
    {
        $shopkeepersToUsersResponse = $this->post('/transaction/', [
            "value" => 100.00,
            "from_user" => "07971257000130",
            "to_user" => "00000000868"
        ]);

        $shopkeepersToUsersResponse->assertStatus(400);
    }

    public function transaction_from_user_to_shopkeepers(): void
    {
        $userToShopkeepersResponse = $this->post('/transaction/', [
            "value" => 100.00,
            "from_user" => "00000000868",
            "to_user" => "07971257000130"
        ]);

        $userToShopkeepersResponse->assertStatus(200);
    }
}
