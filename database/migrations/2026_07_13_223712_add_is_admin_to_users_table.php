<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Necessário porque o painel Filament (app/admin) autentica contra a
     * MESMA tabela users do app. Sem esta coluna + a checagem em
     * User::canAccessPanel(), qualquer estudante cadastrado no app
     * conseguiria tentar logar em /admin com as próprias credenciais.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('email_verified_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }
};
