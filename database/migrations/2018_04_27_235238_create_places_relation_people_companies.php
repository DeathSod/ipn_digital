<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlacesRelationPeopleCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('people', function (Blueprint $table){
            $table->unsignedInteger('PE_FK_PL');
            $table->foreign('PE_FK_PL')->references('PL_id')->on('places')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('companies', function (Blueprint $table){
            $table->unsignedInteger('CO_FK_PL');
            $table->foreign('CO_FK_PL')->references('PL_id')->on('places')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
