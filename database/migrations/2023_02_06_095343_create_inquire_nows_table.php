<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInquireNowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquire_nows', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('inquiry_about')->nullable();
            $table->string('phone')->nullable();
            $table->string('message')->nullable();
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
        Schema::dropIfExists('inquire_nows');
    }
}
