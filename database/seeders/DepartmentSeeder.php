<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = DB::table('import_ideam')
            ->select('department')
            ->distinct()
            ->whereNotNull('department')
            ->pluck('department')
            ->unique()
            ->toArray();

        foreach ($departments as $department) {
            DB::table('departments')->insert([
                'name' => trim($department),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
