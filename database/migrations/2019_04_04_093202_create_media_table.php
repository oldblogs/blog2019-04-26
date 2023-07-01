<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('media', function (Blueprint $table) {
        $table->increments('id');
        $table->boolean('enabled')->default(FALSE);
        $table->string('description')->nullable();
        $table->integer('medium_type_id');
        $table->integer('license_id')->nullable();  
        $table->string('file')->nullable();         // local the media file
        $table->text('external_url')->nullable();   // url to the media
        $table->text('stock_url')->nullable();     // stock url , original source url of the stock media
        $table->string('stock_desc')->nullable();  // stock credit description of media
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
        Schema::dropIfExists('media');
    }
}
