<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('event_sessions', function (Blueprint $table) {
            $table->time('start_time')->change();
            $table->time('end_time')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('event_sessions', function (Blueprint $table) {
            $table->string('start_time')->change();
            $table->string('end_time')->nullable()->change();
        });
    }
};
