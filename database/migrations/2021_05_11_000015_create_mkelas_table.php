<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMkelasTable extends Migration
{
    public function up()
    {
        Schema::create('mkelas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama')->unique();
            $table->integer('kuota');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
