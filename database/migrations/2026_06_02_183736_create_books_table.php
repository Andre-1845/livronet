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
        Schema::create('books', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('subject_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');

            $table->string('author');

            $table->string('publisher')
                ->nullable();

            $table->string('edition')
                ->nullable();

            $table->string('isbn')
                ->nullable();

            $table->decimal('price', 10, 2)
                ->nullable();

            $table->boolean('accept_trade')
                ->default(false);

            $table->boolean('accept_sale')
                ->default(false);

            $table->boolean('accept_donation')
                ->default(false);

            $table->text('description')
                ->nullable();

            $table->string('image')
                ->nullable();

            $table->boolean('is_available')
                ->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};