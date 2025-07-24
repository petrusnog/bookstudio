<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Availabilities
 *
 * Manages the availability of studios or rooms, controlling the display
 * of the scheduling window for rehearsals.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('studio_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('room_id')->nullable()->constrained()->onDelete('cascade');
            $table->json('weekdays');
            $table->time('open_time');
            $table->time('close_time');
            $table->timestamps();
        });

        /**
         * The section below is a database-level constraint that prevents
         * records from associating an availability with both a studio
         * and a room at the same time.
         */
        DB::statement("
            ALTER TABLE availabilities
            ADD CONSTRAINT only_one_relation
            CHECK (
                (studio_id IS NULL AND room_id IS NOT NULL)
                OR
                (studio_id IS NOT NULL AND room_id IS NULL)
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('availabilities');
    }
};
