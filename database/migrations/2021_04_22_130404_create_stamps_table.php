<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStampsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stamps', function (Blueprint $table) {
            $table->id('stampid');
            $table->dateTime('go_time');
            $table->dateTime('leave_time')->nullable();
            $table->smallInteger('carfare')->default('0');
            $table->unsignedBigInteger('user_userid');
            $table->unsignedTinyInteger('salary_confirmed_status')->default('0');
            $table->foreign('user_userid')->references('userid')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stamps');
    }
}
