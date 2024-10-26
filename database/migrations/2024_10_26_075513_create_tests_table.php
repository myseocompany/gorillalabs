<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_id')->constrained('labs')->onDelete('cascade');
            $table->string('accreditation_status');
            $table->string('matrix');
            $table->string('component');

            // Nuevas columnas para relacionar con `test_activities` y `test_activity_types`
            $table->unsignedBigInteger('activity_id')->nullable();
            $table->unsignedBigInteger('activity_type_id')->nullable();

            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('municipality_id')->nullable();

            $table->string('group');
            $table->string('variable');
            $table->string('technique');
            $table->string('method');
            $table->string('direct_measurement_interval')->nullable();
            $table->string('station_name')->nullable();
            $table->string('station_address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('equipment_identification')->nullable();
            $table->timestamps();

            // Definir las claves foráneas
            $table->foreign('activity_id')->references('id')->on('test_activities')->onDelete('set null');
            $table->foreign('activity_type_id')->references('id')->on('test_activity_types')->onDelete('set null');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('set null');
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
