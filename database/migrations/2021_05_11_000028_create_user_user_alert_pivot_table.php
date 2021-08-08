<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserUserAlertPivotTable extends Migration
{
    public function up()
    {
        Schema::create('user_user_alert', function (Blueprint $table) {
            $table->unsignedBigInteger('user_alert_id');
            $table->foreign('user_alert_id', 'user_alert_id_fk_3871282')->references('id')->on('user_alerts')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_3871282')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('read')->default(0);
        });
    }
}
