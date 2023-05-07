<?php

declare(strict_types=1);

namespace Migration;

use Cycle\Migrations\Migration;

class OrmDefaultC75a0e39c1133bf93e6bce9edc7769a8 extends Migration
{
    protected const DATABASE = 'default';

    public function up(): void
    {
        $this->table('users')
        ->addColumn('created_at', 'datetime', ['nullable' => false, 'default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated_at', 'datetime', ['nullable' => false, 'default' => null])
        ->update();
    }

    public function down(): void
    {
        $this->table('users')
        ->dropColumn('created_at')
        ->dropColumn('updated_at')
        ->update();
    }
}
