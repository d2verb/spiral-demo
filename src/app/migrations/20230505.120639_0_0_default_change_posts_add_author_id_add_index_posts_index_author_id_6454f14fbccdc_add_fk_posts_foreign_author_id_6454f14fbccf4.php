<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefault4d9974ce13bf36be2495eea6c2a45be4 extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('posts')
        ->addColumn('author_id', 'integer', ['nullable' => false, 'default' => null])
        ->addIndex(['author_id'], ['name' => 'posts_index_author_id_6454f14fbccdc', 'unique' => false])
        ->addForeignKey(['author_id'], 'users', ['id'], [
            'name' => 'posts_foreign_author_id_6454f14fbccf4',
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
        ])
        ->update();
    }

    public function down(): void
    {
        $this->table('posts')
        ->dropForeignKey(['author_id'])
        ->dropIndex(['author_id'])
        ->dropColumn('author_id')
        ->update();
    }
}
