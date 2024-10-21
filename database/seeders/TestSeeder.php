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
                // Insertar el test en la tabla tests
                DB::table('tests')->insert([
                    'lab_id' => $lab->id,
                    'accreditation_status' => trim($test->{'Estado de la Acreditación'}),
                    'matrix' => trim($test->Matriz),
                    'component' => trim($test->Componente),
                    'activity' => trim($test->Actividad),
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
