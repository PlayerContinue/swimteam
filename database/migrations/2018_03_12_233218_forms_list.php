<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FormsList extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('form', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("name",300);
            $table->string("form_key","32")->unique();
        });
        Schema::create('form_keys',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string("key",50);//name of a form value input
            $table->string('form_key',"32");
            $table->foreign('form_key')->references('form_key')->on('form')->onDelete('cascade');//Foreign Key connection
        });
        Schema::create('form_submission_keys',function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('form_key',"32");
            $table->foreign('form_key')->references('form_key')->on('form')->onDelete('cascade');//Foreign Key connection
        });
         Schema::create('form_submission', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('field');
            $table->string('value');
            //$table->string('form_key',"32");
            $table->integer('form_data_id')->unsigned();
            //$table->foreign('form_key')->references('form_key')->on('forms')->onDelete('cascade');//Foreign Key connection
            $table->foreign('form_data_id')->references('id')->on('form_submission_keys')->onDelete('cascade');//Foreign Key for Results
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('forms');
        Schema::dropIfExists('form_keys');
        Schema::dropIfExists('form_submission_keys');
        Schema::dropIfExists('form_data');
    }

}
