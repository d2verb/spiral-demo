<?php

declare(strict_types=1);


namespace Database\Factory;

use App\Domain\User\Entity\User;
use Spiral\DatabaseSeeder\Factory\AbstractFactory;

final class UserFactory extends AbstractFactory
{
    public function entity(): string
    {
        return User::class;
    }

    public function makeEntity(array $definition): User
    {
        return new User($definition['username'], $definition['email']);
    }

    public function definition(): array
    {
        return [
            'username' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
        ];
    }
}
