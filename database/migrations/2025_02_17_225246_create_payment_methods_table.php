<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Insertar métodos de pago predeterminados
        DB::table('payment_methods')->insert([
            ['name' => 'Transferencia bancaria'],
            ['name' => 'Efectivo'],
            ['name' => 'Nequi'],
            ['name' => 'Daviplata'],
            ['name' => 'Pago en línea'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
