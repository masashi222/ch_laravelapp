<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creations', function (Blueprint $table) {
            $table->id('creationid');
            $table->time('go_time');
            $table->time('leave_time');
            $table->tinyInteger('creation_status')->default('0');
            $table->unsignedBigInteger('submittal_submittalid');
            $table->foreign('submittal_submittalid')->references('submittalid')->on('submittals');
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
        Schema::dropIfExists('creations');
    }
}
