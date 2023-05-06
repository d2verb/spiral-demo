<?php

declare(strict_types=1);

namespace App\Database;

use App\Repository\UserRepository;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\ORM\Entity\Behavior\CreatedAt;
use Cycle\ORM\Entity\Behavior\Event\Mapper\Command\OnCreate;
use Cycle\ORM\Entity\Behavior\Hook;
use Cycle\ORM\Entity\Behavior\UpdatedAt;
use Ramsey\Uuid\Uuid;

#[Entity(repository: UserRepository::class)]
#[CreatedAt(field: 'createdAt', column: 'created_at')]
#[UpdatedAt(field: 'updatedAt', column: 'updated_at')]
#[Hook(
    callable: [User::class, 'onCreate'],
    events: OnCreate::class
)]
class User
{
    #[Column(type: 'uuid', primary: true)]
    public string $id;

    public function __construct(
        #[Column(type: 'string')]
        public string $name,

        #[Column(type: 'string')]
        public string $email
    ) {
    }

    public static function onCreate(OnCreate $event): void
    {
        $pkColumn = 'id';
        if (!isset($event->state->getData()[$pkColumn])) {
            $event->state->register($pkColumn, Uuid::uuid7());
        }
    }
}
