<?php

declare(strict_types=1);

namespace Database\Seeder;

use Database\Factory\CommentFactory;
use Database\Factory\PostFactory;
use Database\Factory\UserFactory;
use Spiral\DatabaseSeeder\Seeder\AbstractSeeder;

class DatabaseSeeder extends AbstractSeeder
{
    public function run(): \Generator
    {
        $users = UserFactory::new()->times(10)->make();
        yield from $users;

        $posts = [];
        foreach (range(1, 100) as $_) {
            $posts[] = PostFactory::new()
                ->withAuthor($users[array_rand($users)])
                ->makeOne();
        }
        yield from $posts;

        foreach (range(1, 100) as $_) {
            yield CommentFactory::new()
                ->withAuthor($users[array_rand($users)])
                ->withPost($posts[array_rand($posts)])
                ->makeOne();
        }
    }
}
