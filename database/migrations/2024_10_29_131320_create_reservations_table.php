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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->boolean('status');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_id');
            $table->timestamps();

            // Definición de llaves foráneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

            // Opcional: agregar índices
            $table->index('user_id');
            $table->index('event_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
