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
        Schema::table('plats', function (Blueprint $table) {
            // Afegim la nova columna 'quantitat' de tipus string.
            // 'nullable()' permet que el camp estigui buit.
            // 'after('descripcio')' la col·loca després de la columna 'descripcio' (opcional, per ordre).
            $table->string('quantitat')->nullable()->after('descripcio');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plats', function (Blueprint $table) {
            // Quan es desfaci aquesta migració, eliminarem la columna 'quantitat'.
            $table->dropColumn('quantitat');
        });
    }
};