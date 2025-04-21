<?php

namespace Database\Seeders;

use App\Models\Committee;
use App\Models\CommitteeMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommitteeMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los comités
        $committees = Committee::all();

        // Asignar el usuario con ID 2 como presidente de cada comité
        foreach ($committees as $committee) {
            CommitteeMember::create([
                'committee_id' => $committee->id,
                'user_id' => 2,
                'role' => 'president',
                'joined_at' => now(),
            ]);
        }
    }
} 