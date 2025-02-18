<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('accreditations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        DB::table('accreditations')->insert([
            ['name' => 'ONAC'],
            ['name' => 'IDEAM'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('accreditations');
    }
};
