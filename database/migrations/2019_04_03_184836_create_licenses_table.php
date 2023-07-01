<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('spdx');      /* SPDX short-form identifiers. spdx.org/licenses/ */
            $table->string('lic_name');  
            $table->text('lic_deed')->nullable();  // license deed link
            $table->text('legal')->nullable();     // legal code link
            $table->boolean('fsf')->nullable()->default(false);      // Free Software Foundation approval
            $table->boolean('osi')->nullable()->default(false);      // Open Source Initiative approval
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
        Schema::dropIfExists('licenses');
    }
}
