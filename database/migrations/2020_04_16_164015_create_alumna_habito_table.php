<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnaHabitoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumna_habito', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
            $table->increments('id');

            
            $table->unsignedBigInteger('alumna_id')->unsigned();
            $table->foreign('alumna_id')->references('id')->on('alumnas');
            $table->unsignedBigInteger('habito_id')->unsigned();
            $table->foreign('habito_id')->references('id')->on('habitos');
            $table->date('fecharegistro');
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
        Schema::dropIfExists('alumna_habito');
    }
}
