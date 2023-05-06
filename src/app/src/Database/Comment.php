<?php

declare(strict_types=1);

namespace App\Database;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\BelongsTo;
use Cycle\ORM\Entity\Behavior\CreatedAt;
use Cycle\ORM\Entity\Behavior\Event\Mapper\Command\OnCreate;
use Cycle\ORM\Entity\Behavior\Hook;
use Cycle\ORM\Entity\Behavior\UpdatedAt;
use Ramsey\Uuid\Uuid;

#[Entity]
#[CreatedAt(field: 'createdAt', column: 'created_at')]
#[UpdatedAt(field: 'updatedAt', column: 'updated_at')]
#[Hook(
    callable: [Comment::class, 'onCreate'],
    events: OnCreate::class
)]
class Comment
{
    #[Column(type: 'uuid', primary: true)]
    public string $id;

    public function __construct(
        #[Column(type: 'string')]
        public string $message,

        #[BelongsTo(target: User::class, nullable: false)]
        public User $author,

        #[BelongsTo(target: Post::class, nullable: false)]
        public Post $post,
    ) {
    }

    public static function onCreate(OnCreate $event): void
    {
        $pkColumn = 'id';
        if (!isset($event->state->getData()[$pkColumn])) {
            $event->state->register($pkColumn, Uuid::uuid7()->toString());
        }
    }
}
