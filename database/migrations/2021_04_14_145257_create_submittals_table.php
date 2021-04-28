<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmittalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submittals', function (Blueprint $table) {
            $table->id('submittalid');
            $table->date('go_date')->nullable();
            $table->time('go_time')->nullable();
            $table->time('leave_time')->nullable();
            $table->tinyInteger('submittal_status')->unsigned()->nullable()->default('0');
            $table->bigInteger('user_userid')->unsigned();
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
        Schema::dropIfExists('submittals');
    }
}
