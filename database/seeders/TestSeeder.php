<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestSeeder extends Seeder
{
    public function run()
    {
        // Obtener los registros de la tabla import_ideam
        $importedTests = DB::table('import_ideam')->get();

        foreach ($importedTests as $test) {
            // Buscar el laboratorio correspondiente utilizando el NIT
            $lab = DB::table('labs')->where('nit', trim($test->Nit))->first();

            if ($lab) {
                // Obtener ambos IDs (activity_id y activity_type_id) en una sola consulta
                $activityData = DB::table('test_activities')
                    ->join('test_activity_types', 'test_activities.type_id', '=', 'test_activity_types.id')
                    ->where('test_activities.name', trim($test->Actividad))
                    ->select('test_activities.id as activity_id', 'test_activity_types.id as activity_type_id')
                    ->first();

                // Buscar el `department_id` correspondiente en la tabla `departments`
                $department = isset($test->department) ? DB::table('departments')
                    ->where('name', trim($test->department))
                    ->first() : null;

                // Buscar el `municipality_id` correspondiente en la tabla `municipalities`
                $municipality = isset($test->municipality) ? DB::table('municipalities')
                    ->where('name', trim($test->municipality))
                    ->first() : null; 

                // Insertar el test en la tabla tests
                DB::table('tests')->insert([
                    'lab_id' => $lab->id,
                    'accreditation_status' => trim($test->{'Estado de la Acreditación'}),
                    'matrix' => trim($test->Matriz),
                    'component' => trim($test->Componente),
                    'activity_id' => $activityData ? $activityData->activity_id : null, // Insertar activity_id
                    'activity_type_id' => $activityData ? $activityData->activity_type_id : null, // Insertar activity_type_id
                    'department_id' => $department ? $department->id : null, // Insertar activity_id
                    'municipality_id' => $municipality ? $municipality->id : null, // Insertar activity_type_id
                    
                    'group' => trim($test->Grupo),
                    'variable' => trim($test->Variable),
                    'technique' => trim($test->Técnica),
                    'method' => trim($test->Método),
                    'direct_measurement_interval' => trim($test->{'Intervalo de medición directa'}),
                    'station_name' => trim($test->{'Nombre de la Estación'}),
                    'station_address' => trim($test->{'Dirección de la Estación'}),
                    'latitude' => trim($test->Latitud),
                    'longitude' => trim($test->Longitud),
                    'equipment_identification' => trim($test->{'Identificación de Equipo'}),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
