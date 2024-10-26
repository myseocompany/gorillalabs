<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TestActivityType; // Asegúrate de que esta línea esté presente y sea correcta

class TestActivitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener los IDs de los tipos de actividad
        $activityTypes = TestActivityType::pluck('id', 'name');

        // Definir las actividades con su tipo correspondiente
        $activities = [
            ['name' => 'Análisis', 'type' => 'Análisis'],
            ['name' => 'Muestreo Puntual', 'type' => 'Muestreo'],
            ['name' => 'Muestreo Compuesto', 'type' => 'Muestreo'],
            ['name' => 'Muestreo Integrado en Cuerpo Lótico', 'type' => 'Muestreo'],
            ['name' => 'Muestreo Integrado en Cuerpo Léntico', 'type' => 'Muestreo'],
            ['name' => 'Muestreo Agua Subterránea', 'type' => 'Muestreo'],
            ['name' => 'Muestreo', 'type' => 'Muestreo'],
            ['name' => 'Determinación', 'type' => 'Determinación'],
            ['name' => 'Muestreo en Cuerpo Lótico', 'type' => 'Muestreo'],
            ['name' => 'Muestreo en Cuerpo Léntico', 'type' => 'Muestreo'],
            ['name' => 'Determinación Directa', 'type' => 'Determinación'],
            ['name' => 'Muestreo Integrado', 'type' => 'Muestreo'],
            ['name' => 'Determinación Directa en Cuerpo Lótico', 'type' => 'Determinación'],
            ['name' => 'Muestreo Automatizado', 'type' => 'Muestreo'],
            ['name' => 'Toma de Muestra Integrada en Cuerpo Lótico', 'type' => 'Muestreo'],
            ['name' => 'Muestreo en Piezómetros', 'type' => 'Muestreo'],
            ['name' => 'Muestreo y Análisis', 'type' => 'Muestreo'],
            ['name' => 'Muestreo Puntual en Cuerpo Lótico', 'type' => 'Muestreo'],
            ['name' => 'Determinación directa en continuo', 'type' => 'Determinación'],
            ['name' => 'Determinación In Situ', 'type' => 'Determinación'],
        ];

        // Insertar las actividades en la tabla `test_activities` con el `type_id`
        foreach ($activities as $activity) {
            DB::table('test_activities')->insert([
                'name' => $activity['name'],
                'type_id' => $activityTypes[$activity['type']] ?? null, // Asignar el `type_id` basado en el nombre
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
