<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefault63163cfc9f7f1439bc6fcdf93d29f6e7 extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('posts')
        ->addColumn('id', 'primary', ['nullable' => false, 'default' => null])
        ->addColumn('title', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->addColumn('content', 'text', ['nullable' => false, 'default' => null])
        ->setPrimaryKeys(['id'])
        ->create();
    }

    public function down(): void
    {
        $this->table('posts')->drop();
    }
}
