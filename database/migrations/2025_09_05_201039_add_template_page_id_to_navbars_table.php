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
        Schema::table('navbars', function (Blueprint $table) {
            $table->unsignedBigInteger('template_page_id')->nullable()->after('id');
            $table->foreign('template_page_id')->references('id')->on('template_pages')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('navbars', function (Blueprint $table) {
            $table->dropForeign(['template_page_id']);
            $table->dropColumn('template_page_id');
        });
    }
};
