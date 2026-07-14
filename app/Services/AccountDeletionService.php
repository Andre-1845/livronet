<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountDeletionService
{
    /**
     * Exclusão de conta = anonimizar + soft delete, NÃO um delete real.
     *
     * Isso é intencional: users tem FKs com cascadeOnDelete em books,
     * conversations e messages. Um delete de verdade apagaria também
     * dados de OUTRAS pessoas (ex: a conversa inteira de quem trocou
     * mensagem com esse usuário, incluindo as mensagens que a outra
     * pessoa escreveu). Anonimizar + soft delete preserva o histórico
     * de quem continua na plataforma, mas remove os dados pessoais de
     * quem pediu a exclusão — o que também é o que a LGPD/Play Store
     * esperam (direito ao esquecimento sem destruir dados de terceiros).
     */
    public function deleteAccount(User $user): void
    {
        // 1. Revoga todos os tokens de acesso (Sanctum) — encerra
        // qualquer sessão ativa em qualquer dispositivo imediatamente.
        $user->tokens()->delete();

        // 2. Livros do usuário: somem da vitrine, mas continuam
        // existindo (soft delete) para não quebrar o histórico de
        // conversas de quem negociou com ele.
        $user->books()->update(['is_available' => false]);
        $user->books()->delete();

        // 3. Anonimiza os dados pessoais. E-mail precisa continuar
        // único (constraint do banco), por isso o padrão abaixo.
        $user->forceFill([
            'name' => 'Usuário removido',
            'email' => 'deleted-'.$user->id.'-'.Str::random(10).'@livronet.invalid',
            'password' => Hash::make(Str::random(40)),
            'phone' => null,
            'whatsapp' => null,
            'instagram' => null,
            'city_id' => null,
            'school_id' => null,
            'is_admin' => false,
        ])->save();

        // 4. Soft delete propriamente dito.
        $user->delete();
    }
}
