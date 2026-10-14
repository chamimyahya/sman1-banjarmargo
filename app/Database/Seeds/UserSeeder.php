<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Creates a first local admin only when explicitly configured and the users table is empty.
 * Never truncates users and never uses a hard-coded default password.
 */
class UserSeeder extends Seeder
{
    public function run()
    {
        if (strtolower(trim((string) env('ALLOW_DEMO_SEEDING', 'false'))) !== 'true') {
            throw new \RuntimeException(
                'Demo seeding is disabled. Set ALLOW_DEMO_SEEDING=true in the local .env only after confirming the database is disposable.'
            );
        }

        if ($this->db->table('users')->countAllResults() > 0) {
            log_message('info', 'UserSeeder skipped because the users table is not empty.');
            return;
        }

        $username = trim((string) env('SEED_ADMIN_USERNAME', ''));
        $email    = trim((string) env('SEED_ADMIN_EMAIL', ''));
        $fullName = trim((string) env('SEED_ADMIN_NAME', 'Administrator'));
        $password = (string) env('SEED_ADMIN_PASSWORD', '');

        if ($username === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 14) {
            log_message('warning', 'UserSeeder skipped: set SEED_ADMIN_USERNAME, SEED_ADMIN_EMAIL, and a unique SEED_ADMIN_PASSWORD of at least 14 characters in the local .env.');
            return;
        }

        $this->db->table('users')->insert([
            'username'  => $username,
            'email'     => $email,
            'password'  => password_hash($password, PASSWORD_DEFAULT),
            'full_name' => $fullName !== '' ? $fullName : 'Administrator',
            'role'      => 'superadmin',
            'is_active' => 1,
        ]);
    }
}
