<?php

declare(strict_types=1);

namespace App\Database;

use App\Repository\PostRepository;
use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\BelongsTo;
use Cycle\Annotated\Annotation\Relation\HasMany;
use Cycle\ORM\Entity\Behavior\CreatedAt;
use Cycle\ORM\Entity\Behavior\Event\Mapper\Command\OnCreate;
use Cycle\ORM\Entity\Behavior\Hook;
use Cycle\ORM\Entity\Behavior\UpdatedAt;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Ramsey\Uuid\Uuid;

#[Entity(repository: PostRepository::class)]
#[CreatedAt(field: 'createdAt', column: 'created_at')]
#[UpdatedAt(field: 'updatedAt', column: 'updated_at')]
#[Hook(
    callable: [Post::class, 'onCreate'],
    events: OnCreate::class
)]
class Post
{
    #[Column(type: 'uuid', primary: true)]
    public string $id;

    #[HasMany(target: Comment::class)]
    public Collection $comments;

    public function __construct(
        #[Column(type: 'string')]
        public string $title,

        #[Column(type: 'string')]
        public string $content,

        #[BelongsTo(target: User::class, nullable: false)]
        public User $author
    ) {
        $this->comments = new ArrayCollection();
    }

    public static function onCreate(OnCreate $event): void
    {
        $pkColumn = 'id';
        if (!isset($event->state->getData()[$pkColumn])) {
            $event->state->register($pkColumn, Uuid::uuid7());
        }
    }
}
