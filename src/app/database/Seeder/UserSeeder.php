<?php

declare(strict_types=1);

namespace Database\Seeder;

use Database\Factory\UserFactory;
use Spiral\DatabaseSeeder\Seeder\AbstractSeeder;

final class UserSeeder extends AbstractSeeder
{
    public function run(): \Generator
    {
        $users = UserFactory::new()->times(100)->make();
        yield from $users;
    }
}
