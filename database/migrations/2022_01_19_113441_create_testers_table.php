<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testers', function (Blueprint $table) {
            $table->id();
            $table->longText('declarant_1')->nullable();
            $table->longText('declarant_2')->nullable();
            $table->longText('address_1')->nullable();
            $table->longText('address_2')->nullable();
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
        Schema::dropIfExists('testers');
    }
}
