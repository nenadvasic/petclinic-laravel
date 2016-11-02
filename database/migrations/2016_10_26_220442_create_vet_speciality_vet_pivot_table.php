<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVetSpecialityVetPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vet_speciality_vet', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->integer('vet_speciality_id')->unsigned()->index();
            $table->foreign('vet_speciality_id')->references('id')->on('vet_specialities')->onDelete('cascade');
            $table->integer('vet_id')->unsigned()->index();
            $table->foreign('vet_id')->references('id')->on('vets')->onDelete('cascade');
            $table->primary(['vet_speciality_id', 'vet_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('vet_speciality_vet');
    }
}
