<?php

declare(strict_types=1);

namespace App\Domain\Post\Repository;

use App\Domain\Post\Entity\Post;

interface PostRepositoryInterface
{
    /**
     * @throws UserNotFoundException
     */
    public function findById(int $id): Post;
}
