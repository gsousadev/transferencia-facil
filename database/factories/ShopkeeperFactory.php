<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Transfer\Models\EloquentORM\Shopkeeper;

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
