<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use RuntimeException;

/**
 * Ensures galleries.updated_at exists and uses MySQL's automatic timestamp.
 * Idempotent so it can safely run against the shipped SQL dump, where the
 * column may already exist.
 */
class AddUpdatedAtToGalleries extends Migration
{
    public function up()
    {
        if (! $this->db->tableExists('galleries')) {
            throw new RuntimeException('Cannot reconcile galleries.updated_at: table galleries does not exist.');
        }

        if (! $this->db->fieldExists('updated_at', 'galleries')) {
            $this->forge->addColumn('galleries', [
                'updated_at' => [
                    'type'    => 'DATETIME',
                    'null'    => true,
                    'default' => null,
                ],
            ]);
        }

        // Both the shipped dump and this migration target MySQL/MariaDB.
        // MODIFY is safe whether the column already existed or was just added.
        $this->db->query(
            'ALTER TABLE `galleries` MODIFY `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
        );
    }

    public function down()
    {
        // The supplied SQL dump already contains this column before migration
        // history is initialized. Dropping it during rollback could destroy a
        // field that belongs to the baseline schema, so rollback is a no-op.
    }
}
