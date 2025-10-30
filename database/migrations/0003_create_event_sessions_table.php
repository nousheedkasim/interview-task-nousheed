<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('event_sessions', function (Blueprint $table) {
            $table->id(); // bigint unsigned AUTO_INCREMENT PRIMARY KEY
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete(); // FK to events.id
            $table->string('title');
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('1 = active, 0 = inactive');
            $table->text('description')->nullable();
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_sessions');
    }
};
