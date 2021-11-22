<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ListingCertificate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('listing_certificate', function (Blueprint $table) {
            $table->id(); 
            $table->foreign('listing_id')->references('id')->on('listing');  
            $table->string('certificate');
            $table->string('signature');
            $table->string('public_key');
            $table->string('blockchain_hash');
            $table->string('blockchain_id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing_certificate');
    }
}
