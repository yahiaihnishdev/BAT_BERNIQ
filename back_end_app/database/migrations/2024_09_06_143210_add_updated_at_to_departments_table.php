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
    Schema::table('departments', function (Blueprint $table) {
        $table->timestamp('updated_at')->nullable(); // Add updated_at column
    });
}

public function down(): void
{
    Schema::table('departments', function (Blueprint $table) {
        $table->dropColumn('updated_at');
    });
}

};