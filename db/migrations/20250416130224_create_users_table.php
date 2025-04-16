<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

class CreateUsersTable extends AbstractMigration
{
    public function change()
    {
        $table = $this->table('users');
        $table->addColumn('name', 'string', ['limit' => 100])
              ->addColumn('email', 'string', ['limit' => 100])
              ->addColumn('password', 'string', ['limit' => 255])
              ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
              ->create();
    }
}

