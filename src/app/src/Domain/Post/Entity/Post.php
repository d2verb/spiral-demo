<?php

declare(strict_types=1);

namespace App\Domain\Post\Entity;

use App\Domain\Post\Repository\PostRepositoryInterface;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;

#[Entity(
    repository: PostRepositoryInterface::class,
)]
class Post
{
    #[Column(type: 'primary')]
    public int $id;

    #[Column(type: 'string')]
    public string $title;

    #[Column(type: 'text')]
    public string $content;
}
