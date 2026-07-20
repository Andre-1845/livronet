<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_templates', function (Blueprint $table) {

            $table->id();

            $table->string('key')->unique();

            $table->string('subject');

            $table->text('body');

            $table->string('button_text');

            $table->text('closing_text')->nullable();

            $table->timestamps();
        });

        // Conteudo inicial identico ao que ja estava fixo no codigo
        // (resources/views/emails/*.blade.php). A partir daqui, o
        // administrador edita esse texto pelo painel Filament, sem
        // precisar de deploy.
        //
        // Tokens suportados no corpo (substituidos em tempo de envio):
        // :name            -> nome do destinatario
        // :expire_minutes  -> validade do link, em minutos (so no e-mail de redefinicao de senha)
        DB::table('email_templates')->insert([
            [
                'key' => 'verify_email',
                'subject' => 'Confirme seu e-mail — LivroNet',
                'body' => '<p>Olá, :name!</p><p>Recebemos seu cadastro no LivroNet. Falta só confirmar seu e-mail para liberar o acesso completo ao app.</p>',
                'button_text' => 'Confirmar e-mail',
                'closing_text' => 'Se você não criou uma conta no LivroNet, pode ignorar este e-mail — nada será feito.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'reset_password',
                'subject' => 'Redefinição de senha — LivroNet',
                'body' => '<p>Olá, :name!</p><p>Recebemos uma solicitação para redefinir a senha da sua conta no LivroNet.</p><p>Este link expira em :expire_minutes minutos.</p>',
                'button_text' => 'Redefinir senha',
                'closing_text' => 'Se você não solicitou isso, pode ignorar este e-mail — sua senha continua a mesma.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'account_deletion',
                'subject' => 'Confirme a exclusão da sua conta — LivroNet',
                'body' => '<p>Olá!</p><p>Recebemos um pedido para excluir sua conta no LivroNet.</p><p>Isso vai remover seus dados pessoais (nome, e-mail, telefone) e tirar seus livros da vitrine permanentemente.</p><p>Se foi você, confirme clicando no botão abaixo. Este link expira em 30 minutos.</p>',
                'button_text' => 'Confirmar exclusão da conta',
                'closing_text' => 'Se você não pediu isso, pode ignorar este e-mail — nada será alterado na sua conta.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_templates');
    }
};
