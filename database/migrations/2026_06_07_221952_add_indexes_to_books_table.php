<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {

            $table->index('subject_id');

            $table->index('grade_id');

            $table->index('user_id');

            $table->index('is_available');

        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {

            $table->dropIndex(['subject_id']);

            $table->dropIndex(['grade_id']);

            $table->dropIndex(['user_id']);

            $table->dropIndex(['is_available']);

        });
    }
};
