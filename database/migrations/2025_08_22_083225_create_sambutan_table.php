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
        Schema::create('sambutan', function (Blueprint $table) {
            $table->id();
            $table->text('isi_sambutan');
            $table->string('nama_pejabat');
            $table->string('jabatan');
            $table->string('foto_pejabat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sambutan');
    }
};
