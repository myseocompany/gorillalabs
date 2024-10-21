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
            $table->string('activity');
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
        });
    }

    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
