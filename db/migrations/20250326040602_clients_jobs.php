<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class ClientsJobs extends AbstractMigration
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
        $table = $this->table('clients_jobs', [
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
        $table->addColumn('occupation', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('salary', 'decimal', [
            'precision' => 12,
            'scale' => 2,
            'null' => true,
            'default' => null
        ]);
        $table->addColumn('start_date', 'date', [
            'null' => false,
        ]);
        $table->addColumn('end_date', 'date', [
            'null' => true,
            'default' => null
        ]);
        $table->addColumn('phone', 'string', [
            'limit' => 20,
            'null' => true,
            'default' => null
        ]);
        $table->addColumn('address', 'text', [
            'null' => true,
            'default' => null
        ]);
        
        $table->addForeignKey('clients_id', 'clients', 'id', [
            'delete' => 'CASCADE',
            'update' => 'NO_ACTION',
            'constraint' => 'fk_jobs_clients'
        ]);
        
        $table->addIndex(['clients_id', 'start_date'], [
            'name' => 'idx_client_job_date'
        ]);
        
        $table->create();
    }
}
