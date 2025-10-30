<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('event_session_speaker', function (Blueprint $table) {
            $table->tinyInteger('status')
                  ->default(1)
                  ->comment('0 = inactive, 1 = active')
                  ->after('speaker_id');
        });
    }

    public function down(): void
    {
        Schema::table('event_session_speaker', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
