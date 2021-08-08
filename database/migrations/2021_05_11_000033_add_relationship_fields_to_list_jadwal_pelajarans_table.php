<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToListJadwalPelajaransTable extends Migration
{
    public function up()
    {
        Schema::table('list_jadwal_pelajarans', function (Blueprint $table) {
            $table->unsignedBigInteger('tahun_ajaran_id');
            $table->foreign('tahun_ajaran_id', 'tahun_ajaran_fk_3880311')->references('id')->on('m_tahun_ajarans');
            $table->unsignedBigInteger('jurusan_id');
            $table->foreign('jurusan_id', 'jurusan_fk_3880312')->references('id')->on('m_jurusans');
            $table->unsignedBigInteger('pelajaran_id');
            $table->foreign('pelajaran_id', 'pelajaran_fk_3880334')->references('id')->on('list_master_pelajarans');
            $table->unsignedBigInteger('guru_id');
            $table->foreign('guru_id', 'guru_fk_3880337')->references('id')->on('m_gurus');
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('kelas_id', 'kelas_fk_3880338')->references('id')->on('mkelas');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id', 'status_fk_3880339')->references('id')->on('statuses');
        });
    }
}
