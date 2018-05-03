<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('creatives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('CR_Name');
            $table->string('CR_Filepath');
            $table->string('CR_Width');
            $table->string('CR_Height');
            $table->text('CR_Description');
            $table->unsignedInteger('CR_FK_US');
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
        Schema::dropIfExists('creatives');
    }
}
