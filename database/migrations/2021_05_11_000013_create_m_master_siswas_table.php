<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMMasterSiswasTable extends Migration
{
    public function up()
    {
        Schema::create('m_master_siswas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->date('tgl_lahir');
            $table->string('nisn')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
