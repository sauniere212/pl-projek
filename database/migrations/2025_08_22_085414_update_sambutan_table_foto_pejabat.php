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
        Schema::table('sambutan', function (Blueprint $table) {
            $table->text('foto_pejabat')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sambutan', function (Blueprint $table) {
            $table->string('foto_pejabat')->change();
        });
    }
};
