<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->id(); // bigint unsigned NOT NULL
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete(); // FK to events.id
            $table->string('name');
            $table->string('expertise')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment('0 = inactive, 1 = active');
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('speakers');
    }
};
