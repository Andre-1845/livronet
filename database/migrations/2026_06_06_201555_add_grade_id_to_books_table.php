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
        Schema::table('books', function (Blueprint $table) {
            $table->foreignId('grade_id')
                ->after('edition')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {

            $table->dropForeign([
                'grade_id',
            ]);

            $table->dropColumn(
                'grade_id'
            );
        });
    }
};
