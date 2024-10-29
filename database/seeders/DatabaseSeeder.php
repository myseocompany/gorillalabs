<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Soporte Rapido',
            'email' => 'soporterapido@myseocompany.co',
            'password' => Hash::make('myseo2025'), // Encripta el password
            
        ]);

        $this->call([
            MatrixSeeder::class,
            LabSeeder::class,
            
            TestActivityTypeSeeder::class,
            
            TestActivitiesSeeder::class,
            DepartmentSeeder::class,
            MunicipalitySeeder::class, 
            TestSeeder::class, 
            
        ]);
    }
}
