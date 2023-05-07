<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefault4d0662961a07457e494b655199ea25f5 extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('comments')
        ->addColumn('created_at', 'datetime', ['nullable' => false, 'default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated_at', 'datetime', ['nullable' => false, 'default' => null])
        ->addColumn('id', 'uuid', ['nullable' => false, 'default' => null, 'size' => 36])
        ->addColumn('message', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->setPrimaryKeys(['id'])
        ->create();
        $this->table('posts')
        ->addColumn('created_at', 'datetime', ['nullable' => false, 'default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated_at', 'datetime', ['nullable' => false, 'default' => null])
        ->addColumn('id', 'uuid', ['nullable' => false, 'default' => null, 'size' => 36])
        ->addColumn('title', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->addColumn('content', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->setPrimaryKeys(['id'])
        ->create();
    }

    public function down(): void
    {
        $this->table('posts')->drop();
        $this->table('comments')->drop();
    }
}
