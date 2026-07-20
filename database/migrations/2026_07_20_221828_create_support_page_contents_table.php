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
        Schema::create('support_page_contents', function (Blueprint $table) {

            $table->id();

            $table->string('title');

            $table->string('subtitle');

            $table->text('intro_text');

            $table->text('why_it_exists_text')->nullable();

            $table->text('why_we_ask_text')->nullable();

            $table->string('pix_key')->nullable();

            $table->string('livepix_url')->nullable();

            $table->string('apoiase_url')->nullable();

            $table->text('transparency_text')->nullable();

            $table->string('contact_email');

            $table->timestamps();
        });

        // Tabela singleton: sempre uma unica linha (id 1), editada pelo
        // painel Filament em vez de resources/views/apoie.blade.php
        // direto no codigo. Conteudo inicial identico ao que ja estava
        // fixo na pagina.
        DB::table('support_page_contents')->insert([

            'title' => 'Apoie o LivroNet',

            'subtitle' => 'Sua doação é opcional, mas faz diferença.',

            'intro_text' => '<p>O <strong>LivroNet</strong> nasceu com um objetivo simples: fazer os livros circularem, em vez de ficarem parados numa estante depois que um estudante termina de usá-los. Cada livro doado, trocado ou repassado é um livro a menos comprado do zero, e um livro a mais chegando a quem precisa e talvez não pudesse pagar por ele.</p>',

            'why_it_exists_text' => '<p>Livros didáticos e acadêmicos são caros, e boa parte deles é usada por poucos meses antes de ir parar numa caixa esquecida. Ao mesmo tempo, tem sempre um outro estudante precisando exatamente daquele livro. O LivroNet aproxima essas duas pontas — sem cobrar comissão, sem intermediar pagamentos, sem transformar isso em negócio.</p><p>É um projeto pensado para <strong>educação</strong>, <strong>economia</strong> no bolso de quem estuda e <strong>sustentabilidade</strong> — reduzir desperdício dando mais vida útil a algo que já existe.</p>',

            'why_we_ask_text' => '<p>O LivroNet é mantido de forma independente, sem investidores e sem publicidade dentro do app. Os custos de servidor, domínio e manutenção saem do bolso de quem desenvolve o projeto. Doações voluntárias ajudam a manter o app no ar, gratuito e sem anúncios, para todos os estudantes que dependem dele.</p>',

            'pix_key' => 'livronet.app@gmail.com',

            'livepix_url' => null,

            'apoiase_url' => null,

            'transparency_text' => '<p>As doações recebidas são usadas exclusivamente para custear a infraestrutura do LivroNet (servidor, domínio e serviços associados) e sua manutenção contínua. O projeto não possui fins lucrativos e não repassa nem vende dados de quem doa ou de quem usa o app.</p>',

            'contact_email' => 'livronet.app@gmail.com',

            'created_at' => now(),

            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_page_contents');
    }
};
