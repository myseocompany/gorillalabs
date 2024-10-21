<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabsTable extends Migration
{
    public function up()
    {
        Schema::create('labs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nit')->nullable();
            $table->string('contact')->nullable();
            $table->string('city')->nullable();
            $table->string('department')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('administrative_acts')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('resolution_compliance')->nullable();
            $table->text('attention_channels')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('labs');
    }
}
