<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListJadwalPelajaransTable extends Migration
{
    public function up()
    {
        Schema::create('list_jadwal_pelajarans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('dari_jam');
            $table->time('sampai_jam');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
