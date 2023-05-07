<?php

declare(strict_types=1);

namespace Database\Factory;

use App\Database\User;
use Spiral\DatabaseSeeder\Factory\AbstractFactory;

class UserFactory extends AbstractFactory
{
    public function entity(): string
    {
        return User::class;
    }

    public function makeEntity(array $definition): User
    {
        return new User($definition['name'], $definition['email']);
    }

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
        ];
    }
}
