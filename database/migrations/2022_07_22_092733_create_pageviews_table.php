<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePageviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pageviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->references('id')->on('nfcprofiles');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->string('page_slug');
            $table->ipAddress('ip_address');
            $table->string('country_name');
            $table->string('region_name');
            $table->string('city_name');
            $table->string('latitude');
            $table->string('longitude');
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
        Schema::dropIfExists('pageviews');
    }
}
