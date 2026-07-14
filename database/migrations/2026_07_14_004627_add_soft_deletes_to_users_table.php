<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Necessário para o fluxo de exclusão de conta (exigência da Play
     * Store): ao excluir a conta, o usuário é anonimizado e soft-deletado
     * em vez de removido de verdade do banco. Isso evita o cascade delete
     * real (books/conversations/messages têm FK com cascadeOnDelete),
     * que apagaria dados de OUTRAS pessoas envolvidas em conversas com
     * esse usuário.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
