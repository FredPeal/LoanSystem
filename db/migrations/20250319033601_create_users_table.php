<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $users = $this->table('users');
        $users->addColumn('username', 'string', ['limit' => 255])
            ->addColumn('firstname', 'string', ['limit'=> 255, 'null'=> true ])
            ->addColumn('lastname', 'string', ['limit'=> 255, 'null'=> true ])
            ->addColumn('phone', 'string', ['limit'=> 255, 'null'=> false ])
            ->addColumn('email', 'string', ['limit'=> 255, 'null'=> false ])
            ->addColumn('password', 'string', ['limit'=> 255, 'null'=> false ])
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated', 'datetime', ['null' => true])
            ->addColumn('is_deleted', 'boolean', ['default' => false])
            ->create();
    }
}
