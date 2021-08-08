<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMJurusansTable extends Migration
{
    public function up()
    {
        Schema::table('m_jurusans', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id', 'status_fk_3872367')->references('id')->on('statuses');
        });
    }
}
