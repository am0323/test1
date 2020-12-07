<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentsTable extends Migration
{
    public function up()
    {
        Schema::create('presents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('season');
            $table->string('seed');
            $table->string('bud');
            $table->string('grow');
            $table->string('flower');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('presents');
    }
}
