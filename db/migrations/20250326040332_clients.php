<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Clients extends AbstractMigration
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
        $table = $this->table('clients', [
            'id' => false,
            'primary_key' => ['id'],
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_unicode_ci'
        ]);
        
        $table->addColumn('id', 'integer', [
            'identity' => true,
            'signed' => false,
        ]);
        $table->addColumn('firstname', 'string', [
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('lastname', 'string', [
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('id_card', 'string', [
            'limit' => 20,
            'null' => false,
        ]);
        
        $table->addIndex(['id_card'], [
            'unique' => true,
            'name' => 'idx_clients_id_card'
        ]);
        
        $table->create();
    }
}
