<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_activities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->unsignedBigInteger('type_id'); // Agregar columna type_id para la relación
            $table->timestamps();

            // Definir la clave foránea
            $table->foreign('type_id')
                  ->references('id')
                  ->on('test_activity_types')
                  ->onDelete('cascade'); // Opcional: elimina los test_activities si se elimina el tipo relacionado
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_activities');
    }
};
