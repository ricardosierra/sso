<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrokersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('sso.brokersTable', 'brokers'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_slug')->unique();
            $table->string('name');
            $table->string('description');
            $table->string('url');
            $table->string('secret');
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
        Schema::dropIfExists(config('sso.brokersTable', 'brokers'));
    }
}
