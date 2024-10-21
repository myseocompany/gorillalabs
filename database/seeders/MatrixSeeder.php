<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatrixSeeder extends Seeder
{
    public function run()
    {
        // Definir las matrices a insertar
        $matrices = [
            ['name' => 'Agua', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Residuos Peligrosos (RESPEL)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aire', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Suelo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lodo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Biota', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sedimento', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Biosólido', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aceite Dieléctrico', 'created_at' => now(), 'updated_at' => now()],
        ];

        // Insertar los registros en la tabla test_matrices
        DB::table('test_matrices')->insert($matrices);
    }
}

