<?php

namespace Database\Factories;

use App\Models\UserApp;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserAppFactory extends Factory
{
    protected $model = UserApp::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name(),
            'last_name' => $this->faker->name(),
            'user_name' => $this->faker->unique()->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email' => $this->faker->unique()->safeEmail(),
            'status' => 1,
            'gender' => "Malre",
            'type' => 1,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }
}
