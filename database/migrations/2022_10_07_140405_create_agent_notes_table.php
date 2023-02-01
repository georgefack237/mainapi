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
        Schema::create('agent_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->references('id')->on('nfcprofiles');
            $table->foreignId('contact_id')->references('id')->on('contacts');
            $table->string('title');
            $table->text('body');
            $table->timestamp('date');
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
        Schema::dropIfExists('agent_notes');
    }
};
