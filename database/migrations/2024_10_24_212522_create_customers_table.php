<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->text('message');
            $table->unsignedBigInteger('test_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
}