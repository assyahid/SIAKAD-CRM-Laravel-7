<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMGurusTable extends Migration
{
    public function up()
    {
        Schema::table('m_gurus', function (Blueprint $table) {
            $table->unsignedBigInteger('kelamin_id');
            $table->foreign('kelamin_id', 'kelamin_fk_3873402')->references('id')->on('mkelamins');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id', 'status_fk_3880047')->references('id')->on('statuses');
        });
    }
}
