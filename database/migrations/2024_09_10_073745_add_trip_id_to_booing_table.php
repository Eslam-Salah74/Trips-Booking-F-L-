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
        Schema::table('bookings', function (Blueprint $table) {
            // Ensure 'trip_id' is already in place or add it before creating the foreign key
            if (!Schema::hasColumn('bookings', 'trip_id')) {
                $table->foreignId('trip_id')->nullable()->constrained('trips')->onDelete('cascade');
            } else {
                $table->foreign('trip_id')->references('id')->on('trips')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropForeign(['trip_id']);
        });
    }
};
