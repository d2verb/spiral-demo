<?php

declare(strict_types=1);

namespace App\Repository;

use App\Domain\Post\Entity\Post;
use App\Domain\Post\Exception\PostNotFoundException;
use App\Domain\Post\Repository\PostRepositoryInterface;
use Cycle\ORM\Select\Repository;

final class CycleORMPostRepository extends Repository implements PostRepositoryInterface
{
    public function findById(int $id): Post
    {
        $user = $this->findByPK($id);

        if ($user === null) {
            throw new PostNotFoundException();
        }

        return $user;
    }
}
