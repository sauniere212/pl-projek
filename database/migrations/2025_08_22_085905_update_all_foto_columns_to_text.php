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
        // Update galeri_foto table
        Schema::table('galeri_foto', function (Blueprint $table) {
            $table->text('foto')->change();
        });

        // Update video_galeri table
        Schema::table('video_galeri', function (Blueprint $table) {
            $table->text('thumbnail')->change();
        });

        // Update beritas table
        Schema::table('beritas', function (Blueprint $table) {
            $table->text('gambar')->change();
        });

        // Update galeris table
        Schema::table('galeris', function (Blueprint $table) {
            $table->text('foto')->change();
        });

        // Update carousels table
        Schema::table('carousels', function (Blueprint $table) {
            $table->text('gambar')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert galeri_foto table
        Schema::table('galeri_foto', function (Blueprint $table) {
            $table->string('foto')->change();
        });

        // Revert video_galeri table
        Schema::table('video_galeri', function (Blueprint $table) {
            $table->string('thumbnail')->change();
        });

        // Revert beritas table
        Schema::table('beritas', function (Blueprint $table) {
            $table->string('gambar')->change();
        });

        // Revert galeris table
        Schema::table('galeris', function (Blueprint $table) {
            $table->string('foto')->change();
        });

        // Revert carousels table
        Schema::table('carousels', function (Blueprint $table) {
            $table->string('gambar')->change();
        });
    }
};
