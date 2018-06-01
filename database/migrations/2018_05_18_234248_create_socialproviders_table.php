<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialprovidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialproviders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider')->unique();   // ex: google
            $table->string('review')->nullable()->default(null); // ex: https://github.com/settings/connections/applications/...
            $table->boolean('enabled')->nullable()->default(false);
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
        Schema::dropIfExists('socialproviders');
    }
}
