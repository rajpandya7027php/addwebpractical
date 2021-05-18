<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnylyticdatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anylyticdatas', function (Blueprint $table) {
            $table->bigIncrements('analytic_id');
            $table->integer('link_id');
            $table->string('userAgent');
            $table->string('user_id');                      
            $table->dateTime('ip');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anylyticdatas');
    }
}
