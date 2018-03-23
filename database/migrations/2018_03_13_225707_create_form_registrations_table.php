<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('field');
            $table->string('value');
            $table->string('form_list_key',"32");
            $table->foreign('form_list_key')->references('form_key')->on('forms_list')->onDelete('cascade');//Foreign Key connection
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_registrations');
    }
}
