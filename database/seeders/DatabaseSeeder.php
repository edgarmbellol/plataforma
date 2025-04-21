<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Solo crear el usuario de prueba si no existe
        if (!User::where('email', 'test@gmail.com')->exists()) {
            User::factory()->create([
                'name' => 'test',
                'email' => 'test@gmail.com',
            ]);
        }

        $this->call([
            AdminUserSeeder::class,
            CommitteeSeeder::class,
            CommitteeMemberSeeder::class,
        ]);
    }
}
