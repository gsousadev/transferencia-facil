<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /** @test  */
    public function only_users_can_transfer_money(): void
    {
        $userToShopkeepersResponse = $this->post('/transaction/', [
            "value" => 100.00,
            "from_user" => "00000000868",
            "to_user" => "07971257000130"
        ]);

        $userToShopkeepersResponse->assertStatus(200);

        $shopkeepersToUsersResponse = $this->post('/transaction/', [
            "value" => 100.00,
            "from_user" => "07971257000130",
            "to_user" => "00000000868"
        ]);

        $shopkeepersToUsersResponse->assertStatus(400);
    }
}
