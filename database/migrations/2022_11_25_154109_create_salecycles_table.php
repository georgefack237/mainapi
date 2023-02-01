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
        Schema::create('salecycles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->references('id')->on('nfcprofiles');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->foreignId('contact_id')->references('id')->on('contacts');
            $table->boolean('is_lead');
            $table->boolean('is_prospect');
            $table->boolean('is_opportunity');
            $table->string('status');
            $table->timestamp('is_lead_date');
            $table->timestamp('is_prospect_date');
            $table->timestamp('is_opportunity_date');
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
        Schema::dropIfExists('salecycles');
    }
};
