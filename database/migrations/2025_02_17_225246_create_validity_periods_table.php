<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('validity_periods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        DB::table('validity_periods')->insert([
            ['name' => '15 días'],
            ['name' => '30 días'],
            ['name' => '60 días'],
            ['name' => 'Otro'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('validity_periods');
    }
};
