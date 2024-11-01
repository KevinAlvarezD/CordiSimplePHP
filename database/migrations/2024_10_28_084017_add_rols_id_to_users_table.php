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
        Schema::table('users', function (Blueprint $table) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('rols_id')->nullable(); // Agrega la columna rols_id

                // Define la llave foránea
                $table->foreign('rols_id')->references('id')->on('rols')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Elimina la llave foránea primero
            $table->dropForeign(['rols_id']);
            // Luego elimina la columna
            $table->dropColumn('rols_id');
        });
    }
};
