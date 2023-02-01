<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qrcodes', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('companyname');
            $table->string('title');
            $table->string('address');
            $table->string('phone1');
            $table->string('phone2')->nullable();
            $table->string('email1')->nullable();
            $table->string('email2')->nullable();
            $table->string('website')->nullable();
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
        Schema::dropIfExists('qrcodes');
    }
};
