<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $municipalities = DB::table('import_ideam')
            ->select('Ciudad', 'Departamento')
            ->distinct()
            ->whereNotNull('Ciudad')
            ->whereNotNull('Departamento')
            ->get();

        foreach ($municipalities as $municipality) {
            $department = DB::table('departments')
                ->where('name', trim($municipality->Departamento))
                ->first();

            if ($department) {
                DB::table('municipalities')->insert([
                    'name' => trim($municipality->Ciudad),
                    'department_id' => $department->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
