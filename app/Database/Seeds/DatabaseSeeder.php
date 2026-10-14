<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // The supplied records are demo content. Require an explicit local opt-in.
        if (strtolower(trim((string) env('ALLOW_DEMO_SEEDING', 'false'))) !== 'true') {
            throw new \RuntimeException(
                'Demo seeding is disabled. Set ALLOW_DEMO_SEEDING=true in the local .env only after confirming the database is disposable.'
            );
        }

        $this->call('App\Database\Seeds\UserSeeder');
        $this->call('App\Database\Seeds\SettingSeeder');
        $this->call('App\Database\Seeds\ProgramSeeder');
        $this->call('App\Database\Seeds\ExtracurricularSeeder');
        $this->call('App\Database\Seeds\AchievementSeeder');
        $this->call('App\Database\Seeds\TestimonialSeeder');
        $this->call('App\Database\Seeds\NewsSeeder');
        $this->call('App\Database\Seeds\EventSeeder');
        $this->call('App\Database\Seeds\FaqSeeder');
        $this->call('App\Database\Seeds\GallerySeeder');
        $this->call('App\Database\Seeds\TeacherSeeder');
        $this->call('App\Database\Seeds\DownloadSeeder');
        $this->call('App\Database\Seeds\MenuSeeder');
    }
}
