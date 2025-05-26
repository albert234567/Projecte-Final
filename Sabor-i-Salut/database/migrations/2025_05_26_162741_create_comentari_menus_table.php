<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('comentari_menus', function (Blueprint $table) {
        $table->id();
        $table->foreignId('usuari_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
        $table->text('comentari');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comentari_menus');
    }
};
