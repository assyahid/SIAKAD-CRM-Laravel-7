<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMMasterSiswasTable extends Migration
{
    public function up()
    {
        Schema::table('m_master_siswas', function (Blueprint $table) {
            $table->unsignedBigInteger('angkatan_id');
            $table->foreign('angkatan_id', 'angkatan_fk_3872343')->references('id')->on('m_tahun_ajarans');
            $table->unsignedBigInteger('jurusan_id');
            $table->foreign('jurusan_id', 'jurusan_fk_3872997')->references('id')->on('m_jurusans');
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('kelas_id', 'kelas_fk_3872998')->references('id')->on('mkelas');
            $table->unsignedBigInteger('kelamin_id');
            $table->foreign('kelamin_id', 'kelamin_fk_3873302')->references('id')->on('mkelamins');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id', 'status_fk_3873386')->references('id')->on('statuses');
        });
    }
}
