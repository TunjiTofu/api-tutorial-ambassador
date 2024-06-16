<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $link = Link::inRandomOrder()->first();
        return [
            'code' => $link->code,
            'user_id' => $link->user->id,
            'ambassador_email' => $link->user->email,
            'first_name' => $this->faker->firstName,
            'last_name'=> $this->faker->lastName,
            'email' => $this->faker->email,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'country'  => $this->faker->country,
            'zip' => $this->faker->postcode,
            'complete' => 1,

        ];
    }
}
