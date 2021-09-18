<?php

namespace Database\Factories;

use App\Infrastructure\Transfer\Models\Shopkeeper;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopkeeperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shopkeeper::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'trading_name' => $this->faker->company,
            'cnpj' => $this->faker->numerify('##############'),
        ];
    }
}
