<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin Sparepart',
                'email' => 'admin@sparepart.com',
                'password' => bcrypt('password'),
                'role' => 'admin_sparepart',
            ],
            [
                'name' => 'Service Manager',
                'email' => 'manager@service.com',
                'password' => bcrypt('password'),
                'role' => 'service_manager',
            ],
        ]);
    }
}
