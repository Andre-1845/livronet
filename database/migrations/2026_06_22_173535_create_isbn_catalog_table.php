<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('isbn_catalog', function (Blueprint $table) {

            $table->id();

            $table->string('isbn', 20)
                ->unique();

            $table->string('title');

            $table->string('author')
                ->nullable();

            $table->string('publisher')
                ->nullable();

            $table->string('published_date')
                ->nullable();

            $table->string('edition')
                ->nullable();

            $table->string('cover_url')
                ->nullable();

            $table->string('local_cover_path')
                ->nullable();

            $table->string('source')
                ->nullable();

            $table->json('subjects')
                ->nullable();

            $table->unsignedInteger('lookup_count')
                ->default(0);

            $table->timestamp('last_lookup_at')
                ->nullable();

            $table->timestamp('last_api_refresh_at')
                ->nullable();

            $table->string('api_response_hash', 64)
                ->nullable();

            $table->boolean('is_active')
                ->default(true);

            $table->timestamps();

            $table->index('isbn');

            $table->index('lookup_count');

            $table->index('last_lookup_at');

            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('isbn_catalog');
    }
};
