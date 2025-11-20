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
        Schema::create('template_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('navbar_id');
            $table->enum('template_type', ['berita', 'sambutan']);
            $table->string('judul_halaman');
            $table->string('judul_content');
            $table->text('isi_content');
            $table->date('tanggal');
            $table->string('kategori')->nullable();
            $table->string('gambar')->nullable();
            $table->string('penulis')->nullable();
            $table->string('nama_pejabat')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('foto_pejabat')->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->foreign('navbar_id')->references('id')->on('navbars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('template_pages');
    }
};
