<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('vet_id')->unsigned()->index();
            $table->integer('pet_id')->unsigned()->index();
            $table->integer('visit_number');
            $table->dateTime('timestamp');
            $table->decimal('pet_weight', 10, 4)->nullable();
            $table->string('description', 1024)->nullable();
            $table->boolean('scheduled')->default(0);
            $table->timestamps();

            $table->foreign('pet_id')->references('id')->on('pets');
            $table->foreign('vet_id')->references('id')->on('vets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('visits');
    }
}
