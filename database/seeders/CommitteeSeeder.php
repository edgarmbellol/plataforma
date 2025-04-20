<?php

namespace Database\Seeders;

use App\Models\Committee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CommitteeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $committees = [
            [
                'name' => 'Ética Médica',
                'slug' => 'etica-medica',
                'description' => 'Comité encargado de velar por la ética en la práctica médica y la atención al paciente.',
            ],
            [
                'name' => 'GAGAS',
                'slug' => 'gagas',
                'description' => 'Grupo Administrativo de Gestión Ambiental y Sanitaria.',
            ],
            [
                'name' => 'Atención Integral Víctimas Violencia Sexual',
                'slug' => 'atencion-integral-victimas-violencia-sexual',
                'description' => 'Comité dedicado a la atención y seguimiento de casos de violencia sexual.',
            ],
            [
                'name' => 'Humanización',
                'slug' => 'humanizacion',
                'description' => 'Comité enfocado en promover la humanización de los servicios de salud.',
            ],
            [
                'name' => 'Historias Clínicas',
                'slug' => 'historias-clinicas',
                'description' => 'Comité responsable de la gestión y auditoría de historias clínicas.',
            ],
            [
                'name' => 'Hospitalario de Emergencias',
                'slug' => 'hospitalario-emergencias',
                'description' => 'Comité encargado de la gestión y respuesta ante emergencias hospitalarias.',
            ],
            [
                'name' => 'COPASST',
                'slug' => 'copasst',
                'description' => 'Comité Paritario de Seguridad y Salud en el Trabajo.',
            ],
            [
                'name' => 'Calidad',
                'slug' => 'calidad',
                'description' => 'Comité dedicado a la gestión y mejora continua de la calidad en los servicios.',
            ],
            [
                'name' => 'Vigilancia Epidemiológica',
                'slug' => 'vigilancia-epidemiologica',
                'description' => 'Comité encargado del seguimiento y control epidemiológico.',
            ],
            [
                'name' => 'Estadísticas Vitales',
                'slug' => 'estadisticas-vitales',
                'description' => 'Comité responsable del análisis y gestión de estadísticas vitales.',
            ],
            [
                'name' => 'Seguridad del Paciente',
                'slug' => 'seguridad-paciente',
                'description' => 'Comité dedicado a garantizar la seguridad en la atención del paciente.',
            ],
            [
                'name' => 'IAAS',
                'slug' => 'iaas',
                'description' => 'Comité de Infecciones Asociadas a la Atención en Salud.',
            ],
            [
                'name' => 'IAMII',
                'slug' => 'iamii',
                'description' => 'Institución Amiga de la Mujer y la Infancia Integral.',
            ],
            [
                'name' => 'RIAS',
                'slug' => 'rias',
                'description' => 'Rutas Integrales de Atención en Salud.',
            ],
            [
                'name' => 'Farmacia y Terapéutica',
                'slug' => 'farmacia-terapeutica',
                'description' => 'Comité encargado de la gestión farmacéutica y terapéutica institucional.',
            ],
        ];

        foreach ($committees as $committee) {
            Committee::create([
                'name' => $committee['name'],
                'slug' => $committee['slug'],
                'description' => $committee['description'],
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
