<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Adds a numeric 'status' column to the 'events' table.
     * 0 = inactive, 1 = active.
     */
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Add an unsigned tiny integer for compact storage
            // Default 1 means newly created events are active
            $table->unsignedTinyInteger('status')
                  ->default(1)
                  ->after('location')
                  ->comment('0 = inactive, 1 = active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the 'status' column when rolling back.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
