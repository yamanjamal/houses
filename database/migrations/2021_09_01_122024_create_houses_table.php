<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('beds');
            $table->integer('baths');
            $table->float('price');
            $table->string('place');
            $table->longText('description');
            $table->string('property_type');
            $table->string('Balcony')->nullable();
            $table->string('Parking')->nullable();
            $table->string('Pool')->nullable();
            $table->string('Beach')->nullable();
            $table->string('Air_condtioning')->nullable();
            $table->string('Pet_friendly')->nullable();
            $table->string('Kid_friendly')->nullable();
            $table->string('approved')->default('inprogress');
            $table->float('rating')->nullable();
            // $table->foreignId('user_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('houses');
    }
}
