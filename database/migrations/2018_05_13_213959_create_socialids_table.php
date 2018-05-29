<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialids', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('socialprovider_id');
            $table->string('accesstoken', 1024);
            $table->string('socialid', 1024);
            $table->string('tokensecret', 1024)->nullable()->default(null);
            $table->dateTime('expires_at')->nullable()->default(null);
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
        Schema::dropIfExists('socialids');
    }
}
