<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            'Análisis',
            'Muestreo Puntual',
            'Muestreo Compuesto',
            'Muestreo Integrado en Cuerpo Lótico',
            'Muestreo Integrado en Cuerpo Léntico',
            'Muestreo Agua Subterránea',
            'Muestreo',
            'Determinación',
            'Muestreo en Cuerpo Lótico',
            'Muestreo en Cuerpo Léntico',
            'Determinación Directa',
            'Muestreo Integrado',
            'Determinación Directa en Cuerpo Lótico',
            'Muestreo Automatizado',
            'Toma de Muestra Integrada en Cuerpo Lótico',
            'Muestreo en Piezómetros',
            'Muestreo y Análisis',
            'Muestreo Puntual en Cuerpo Lótico',
            'Determinación directa en continuo',
            'Determinación In Situ',
        ];

        // Insertar las actividades en la tabla `test_activities`
        foreach ($activities as $activity) {
            DB::table('test_activities')->insert([
                'name' => $activity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
