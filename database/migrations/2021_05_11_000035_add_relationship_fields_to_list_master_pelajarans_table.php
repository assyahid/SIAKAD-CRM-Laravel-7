<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToListMasterPelajaransTable extends Migration
{
    public function up()
    {
        Schema::table('list_master_pelajarans', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id', 'status_fk_3880323')->references('id')->on('statuses');
        });
    }
}
