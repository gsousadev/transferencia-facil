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
        $response = $this->post('/transaction/', [
            "value" => 100.00,
            "from_user" => "00000000868",
            "to_user" => ""
        ]);

        $response->assertStatus(200);
    }
}
