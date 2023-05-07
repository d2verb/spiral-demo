<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefaultC65ab41da7bd3a429616608e4d566fce extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('posts')
        ->addColumn('author_id', 'uuid', ['nullable' => false, 'default' => null, 'size' => 36])
        ->addIndex(['author_id'], ['name' => 'posts_index_author_id_64565c318dc2d', 'unique' => false])
        ->addForeignKey(['author_id'], 'users', ['id'], [
            'name' => 'posts_foreign_author_id_64565c318dc3c',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
        ])
        ->update();
        $this->table('comments')
        ->addColumn('author_id', 'uuid', ['nullable' => false, 'default' => null, 'size' => 36])
        ->addColumn('post_id', 'uuid', ['nullable' => false, 'default' => null, 'size' => 36])
        ->addIndex(['author_id'], ['name' => 'comments_index_author_id_64565c318d861', 'unique' => false])
        ->addIndex(['post_id'], ['name' => 'comments_index_post_id_64565c318db73', 'unique' => false])
        ->addForeignKey(['author_id'], 'users', ['id'], [
            'name' => 'comments_foreign_author_id_64565c318d879',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
        ])
        ->addForeignKey(['post_id'], 'posts', ['id'], [
            'name' => 'comments_foreign_post_id_64565c318db85',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
        ])
        ->update();
    }

    public function down(): void
    {
        $this->table('comments')
        ->dropForeignKey(['author_id'])
        ->dropForeignKey(['post_id'])
        ->dropIndex(['author_id'])
        ->dropIndex(['post_id'])
        ->dropColumn('author_id')
        ->dropColumn('post_id')
        ->update();
        $this->table('posts')
        ->dropForeignKey(['author_id'])
        ->dropIndex(['author_id'])
        ->dropColumn('author_id')
        ->update();
    }
}
