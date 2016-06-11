<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('status');
            $table->integer('provider_id');
            $table->foreign('provider_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('agent_id');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('city');
            $table->string('district');
            $table->string('address');
            $table->integer('price');
            $table->integer('area');
            $table->integer('buildyear');
            $table->text('description');
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
        Schema::drop('houses');
    }
}
