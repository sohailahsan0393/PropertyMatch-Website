<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('property_title');
            $table->string('property_status');
            $table->string('property_category');
            $table->decimal('price', 12, 9);
            $table->string('location');
            $table->text('map_url');
            $table->text('description');
            $table->integer('land_area');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('floors');
            $table->json('legal_docs');
            $table->json('images');
            $table->string('video')->nullable();
            $table->json('amenities');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('registrations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
