<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AchievementSeeder extends Seeder
{
    public function run()
    {
        if (strtolower(trim((string) env('ALLOW_DEMO_SEEDING', 'false'))) !== 'true') {
            throw new \RuntimeException(
                'Demo seeding is disabled. Set ALLOW_DEMO_SEEDING=true in the local .env only after confirming the database is disposable.'
            );
        }

        if ($this->db->table('achievements')->countAllResults() > 0) {
            log_message('info', 'achievements seeder skipped because the table is not empty.');
            return;
        }
        $data = [
            ['student_name' => 'Alya Putri', 'class_name' => 'Kelas XII IPA', 'achievement' => 'Juara 1 Olimpiade Sains Nasional', 'level' => 'Nasional', 'year' => 2026, 'medal' => 'gold', 'sort_order' => 1],
            ['student_name' => 'Raka Firmansyah', 'class_name' => 'Kelas XI IPS', 'achievement' => 'Juara 2 Lomba Debat Bahasa Inggris Provinsi', 'level' => 'Provinsi', 'year' => 2026, 'medal' => 'silver', 'sort_order' => 2],
            ['student_name' => 'Sinta Nurhaliza', 'class_name' => 'Kelas X IPA', 'achievement' => 'Medali Emas Olimpiade Matematika', 'level' => 'Nasional', 'year' => 2026, 'medal' => 'gold', 'sort_order' => 3],
            ['student_name' => 'Dimas Aditya', 'class_name' => 'Kelas XII IPA', 'achievement' => 'Juara 1 Taekwondo Tingkat Kota', 'level' => 'Kota', 'year' => 2026, 'medal' => 'bronze', 'sort_order' => 4],
            ['student_name' => 'Nindy Ayu', 'class_name' => 'Kelas XI IPA', 'achievement' => 'Harapan 1 Lomba Karya Ilmiah Remaja', 'level' => 'Provinsi', 'year' => 2025, 'medal' => 'silver', 'sort_order' => 5],
            ['student_name' => 'Bayu Prasetyo', 'class_name' => 'Kelas X IPS', 'achievement' => 'Juara 3 Desain Grafis Tingkat Nasional', 'level' => 'Nasional', 'year' => 2025, 'medal' => 'gold', 'sort_order' => 6],
        ];

        $this->db->table('achievements')->insertBatch($data);
    }
}
