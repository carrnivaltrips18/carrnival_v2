<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('header_contents', function (Blueprint $table) {
            $table->boolean('status')->default(1); // 1 for active, 0 for inactive
            $table->integer('flag')->nullable()->default(null); // Nullable flag column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('header_contents', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('flag');
        });
    }

};
