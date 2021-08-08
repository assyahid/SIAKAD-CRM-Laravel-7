<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMGurusTable extends Migration
{
    public function up()
    {
        Schema::create('m_gurus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('nik');
            $table->date('tgl_lahir');
            $table->string('tempat_lahir');
            $table->date('mulai_bekerja');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
