<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use phpDocumentor\Reflection\Types\Null_;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->increments('PL_id');
            $table->string('PL_Name');
            $table->string('PL_Type');
            $table->unsignedInteger('PL_FK_PL')->nullable();
            $table->foreign('PL_FK_PL')->references('PL_id')->on('places')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('places')->insert(
            array(
                ['PL_Name' => 'Argentina', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Australia', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Belgium', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Bolivia', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Brazil', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Canada', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Chile', 'PL_Type' => 'Country'],
                ['PL_Name' => 'China', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Colombia', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Costa Rica', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Cuba', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Denmark', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Dominican Republic', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Ecuador', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Egypt', 'PL_Type' => 'Country'],
                ['PL_Name' => 'El Salvador', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Finland', 'PL_Type' => 'Country'],
                ['PL_Name' => 'France', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Germany', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Greece', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Guatemala', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Honduras', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Ireland', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Israel', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Italy', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Japan', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Luxembourg', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Mexico', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Morocco', 'PL_Type' => 'Country'],
                ['PL_Name' => 'New Zealand', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Panama', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Paraguay', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Peru', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Portugal', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Russia', 'PL_Type' => 'Country'],
                ['PL_Name' => 'South Africa', 'PL_Type' => 'Country'],
                ['PL_Name' => 'South Korea', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Spain', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Sweden', 'PL_Type' => 'Country'],
                ['PL_Name' => 'United Kingdom', 'PL_Type' => 'Country'],
                ['PL_Name' => 'United States', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Uruguay', 'PL_Type' => 'Country'],
                ['PL_Name' => 'Venezuela', 'PL_Type' => 'Country']
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
