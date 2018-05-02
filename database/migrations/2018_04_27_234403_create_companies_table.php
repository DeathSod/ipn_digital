<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('CO_id');
            $table->string('CO_Name');
            $table->string('CO_ContactName');
            $table->string('CO_ContactLastName');
            $table->text('CO_Website');
            $table->string('CO_WorkArea');
            $table->unsignedInteger('CO_FK_US');
            $table->foreign('CO_FK_US')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('companies');
    }
}
