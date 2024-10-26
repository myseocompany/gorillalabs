<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TestActivityType;

class TestActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $activityTypes = [
            ['name' => 'Análisis'],
            ['name' => 'Muestreo'],
            ['name' => 'Determinación'],
        ];

        foreach ($activityTypes as $type) {
            TestActivityType::create($type);
        }
    }
}
