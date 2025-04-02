<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ClietsAddress extends AbstractMigration
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
        $table = $this->table('clients_address', [
            'id' => false,
            'primary_key' => ['id'],
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_unicode_ci'
        ]);
        
        $table->addColumn('id', 'integer', [
            'identity' => true,
            'signed' => false,
        ]);
        $table->addColumn('clients_id', 'integer', [
            'signed' => false,
            'null' => false,
        ]);
        $table->addColumn('name', 'string', [
            'limit' => 100,
            'null' => false,
        ]);
        $table->addColumn('address', 'text', [
            'null' => false,
        ]);
        
        $table->addForeignKey('clients_id', 'clients', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
            'constraint' => 'fk_address_clients'
        ]);
        
        $table->addIndex(['clients_id'], [
            'name' => 'idx_client_address'
        ]);
        
        $table->create();
    }
}
