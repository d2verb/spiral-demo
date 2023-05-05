<?php

declare(strict_types=1);

namespace App\Domain\Post\Entity;

use App\Domain\Post\Repository\PostRepositoryInterface;
use App\Domain\User\Entity\User;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation;

#[Entity(
    repository: PostRepositoryInterface::class,
)]
class Post
{
    #[Column(type: 'primary')]
    public int $id;

    public function __construct(
        #[Column(type: 'string')]
        public string $title,

        #[Column(type: 'text')]
        public string $content,

        #[Relation\BelongsTo(target: User::class, nullable: false)]
        public User $author
    ) {
    }
}
