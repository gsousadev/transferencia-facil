<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Infrastructure\Transfer\Models\EloquentORM\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'cpf' => $this->faker->numerify('###########'),
            'password'=> $this->faker->password,
        ];
    }
}
