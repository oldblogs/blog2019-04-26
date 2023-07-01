<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediumTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* https://developer.mozilla.org/en-US/docs/Web/HTTP/Basics_of_HTTP/MIME_types */

        Schema::create('medium_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mtype');    // MIME type
            $table->string('msubtype'); // MIME subtype
            $table->string('mclass');   // discrete or multipart
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
        Schema::dropIfExists('medium_types');
    }
}
