<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProgramSeeder extends Seeder
{
    public function run()
    {
        if (strtolower(trim((string) env('ALLOW_DEMO_SEEDING', 'false'))) !== 'true') {
            throw new \RuntimeException(
                'Demo seeding is disabled. Set ALLOW_DEMO_SEEDING=true in the local .env only after confirming the database is disposable.'
            );
        }

        if ($this->db->table('programs')->countAllResults() > 0) {
            log_message('info', 'programs seeder skipped because the table is not empty.');
            return;
        }
        $data = [
            ['title' => 'Sains & Teknologi', 'description' => 'Laboratorium modern dan pembelajaran berbasis proyek untuk riset dan inovasi.', 'icon' => 'fas fa-flask', 'sort_order' => 1],
            ['title' => 'Seni & Budaya', 'description' => 'Wadah pengembangan bakat seni melalui musik, tari, teater, dan seni rupa.', 'icon' => 'fas fa-palette', 'sort_order' => 2],
            ['title' => 'Olahraga', 'description' => 'Fasilitas lengkap dan pembinaan atlet muda di berbagai cabang olahraga.', 'icon' => 'fas fa-running', 'sort_order' => 3],
            ['title' => 'Bahasa Asing', 'description' => 'Program bilingual dengan native speaker untuk menghadapi era globalisasi.', 'icon' => 'fas fa-globe', 'sort_order' => 4],
            ['title' => 'Karakter & Religi', 'description' => 'Pendidikan karakter berbasis nilai agama untuk pribadi berakhlak mulia.', 'icon' => 'fas fa-hand-holding-heart', 'sort_order' => 5],
            ['title' => 'Digital Literacy', 'description' => 'Pembelajaran coding, desain grafis, dan literasi digital untuk era 4.0.', 'icon' => 'fas fa-laptop-code', 'sort_order' => 6],
        ];

        $this->db->table('programs')->insertBatch($data);
    }
}
