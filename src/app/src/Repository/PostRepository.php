<?php

declare(strict_types=1);

namespace App\Repository;

use Cycle\ORM\Select;
use Cycle\ORM\Select\Repository;
use Spiral\Prototype\Annotation\Prototyped;

#[Prototyped(property: 'posts')]
class PostRepository extends Repository
{
    public function findAllWithAuthor(): Select
    {
        return $this->select()->load('author');
    }
}
