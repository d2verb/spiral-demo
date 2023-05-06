<?php

declare(strict_types=1);

namespace Database\Factory;

use App\Database\Post;
use App\Database\User;
use Faker\Generator;
use Spiral\DatabaseSeeder\Factory\AbstractFactory;

class PostFactory extends AbstractFactory
{
    public function entity(): string
    {
        return Post::class;
    }

    public function makeEntity(array $definition): Post
    {
        return new Post($definition['title'], $definition['content'], $definition['author']);
    }

    public function withAuthor(User $author): self
    {
        return $this->state(fn (Generator $faker, array $definition) => [
            'author' => $author,
        ]);
    }

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(12),
            'content' => $this->faker->text(200),
            'author' => UserFactory::new()->makeOne()
        ];
    }
}
