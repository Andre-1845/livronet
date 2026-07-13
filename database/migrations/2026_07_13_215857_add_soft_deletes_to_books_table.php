<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adiciona soft delete em books para que a exclusão de um livro
     * não quebre o histórico de conversas/mensagens associadas a ele
     * (o livro passa a ficar "apagado" logicamente, mas a referência
     * continua existindo para quem já conversou sobre ele).
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
