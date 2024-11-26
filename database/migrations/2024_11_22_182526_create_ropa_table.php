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
        Schema::create('ropa', function (Blueprint $table) {
            $table->ropa_id();
            $table->string('tipo');
            $table->integer('cantidad');
            $table->boolean('estado'); 
            $table->foreignId('inventario_id')->constrained('inventario')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ropa');
    }
};
