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
        Schema::create('forms_list', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("name",300);
            $table->string("form_key","32")->unique();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('forms_list');
    }

}
