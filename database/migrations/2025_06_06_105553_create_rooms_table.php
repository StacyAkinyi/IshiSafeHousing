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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('agent_id')->constrained(table: 'users', indexName: 'rooms_agent_id')->onDelete('cascade');
            $table->string('room_number')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('rent');
            $table->integer('capacity')->default(1);
            $table->boolean('is_available')->default(true);
            $table->string('image')->nullable(); // Assuming you want to store an image path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
