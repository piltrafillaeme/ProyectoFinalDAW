<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
                $table->charset = 'utf8';
                $table->collation = 'utf8_unicode_ci';
                $table->bigIncrements('id');
                $table->string('nombretema',50);
                $table->integer('numerotema');
                $table->unsignedBigInteger('profesor_id')->unsigned()->default(1);;
                $table->foreign('profesor_id')->references('id')->on('profesores');
                $table->unsignedBigInteger('curso_id')->unsigned();
                $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
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
        Schema::dropIfExists('temas');
    }
}
