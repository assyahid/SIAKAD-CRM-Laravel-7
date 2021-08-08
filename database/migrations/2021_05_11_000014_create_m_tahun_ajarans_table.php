<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMTahunAjaransTable extends Migration
{
    public function up()
    {
        Schema::create('m_tahun_ajarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
