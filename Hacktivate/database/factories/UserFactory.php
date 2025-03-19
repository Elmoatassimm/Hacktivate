<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Default password
            'remember_token' => Str::random(10),
            'role' => 'club_manager', // Default role
        ];
    }

    public function admin()
    {
        return $this->state([
            'role' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'), // Set a secure password
        ]);
    }
}
