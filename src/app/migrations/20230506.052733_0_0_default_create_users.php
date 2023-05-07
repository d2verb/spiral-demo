<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefaultF7f965419687faa17b2a72bbd640747b extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('users')
        ->addColumn('id', 'uuid', ['nullable' => false, 'default' => null, 'size' => 36])
        ->addColumn('name', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->addColumn('email', 'string', ['nullable' => false, 'default' => null, 'size' => 255])
        ->setPrimaryKeys(['id'])
        ->create();
    }

    public function down(): void
    {
        $this->table('users')->drop();
    }
}
