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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('tripname');
            $table->decimal('price', 10, 2)->nullable();
            $table->string('featured_img')->nullable();
            $table->json('img_gallery')->nullable(); // To store multiple images in JSON format
            $table->foreignId('city_id')->constrained()->onDelete('cascade'); // Ensure cities table exists
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Ensure categories table exists
            $table->text('subdescription')->nullable();
            // $table->text('overview')->nullable();
            // $table->json('details')->nullable();
            // $table->json('packageprice')->nullable();
            $table->json('description')->nullable();
            $table->text('FlightSchedules')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
