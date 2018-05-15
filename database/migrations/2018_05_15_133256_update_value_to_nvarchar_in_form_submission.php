<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateValueToNvarcharInFormSubmission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_submission', function(Blueprint $table){
           $table->mediumText('value')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_submission', function(Blueprint $table){
           $table->string('value',191)->change();
        });
    }
}
