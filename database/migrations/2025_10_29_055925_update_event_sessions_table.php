<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('event_sessions', function (Blueprint $table) {
            $table->renameColumn('time', 'start_time');
            $table->string('end_time')->nullable()->after('start_time');
            $table->unsignedTinyInteger('status')->default(1)->comment('1 = active, 0 = inactive')->after('end_time');
            $table->text('description')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('event_sessions', function (Blueprint $table) {
            $table->renameColumn('start_time', 'time');
            $table->dropColumn(['end_time', 'status', 'description']);
        });
    }
};
