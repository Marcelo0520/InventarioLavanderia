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
        Schema::table('movimiento', function (Blueprint $table) {
            $table->string('estado')->after('tipoRopa')->default('limpia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movimiento', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
};
