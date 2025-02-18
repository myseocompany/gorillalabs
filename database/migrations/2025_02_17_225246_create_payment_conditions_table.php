<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        DB::table('payment_conditions')->insert([
            ['name' => '50% para iniciar, 50% al entregar resultados'],
            ['name' => '100% contraentrega de los resultados'],
            ['name' => '100% anticipado'],
            ['name' => '100% mes vencido'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_conditions');
    }
};
