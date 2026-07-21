<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>LivroNet - Troque, Doe e Reutilize Livros</title>
<meta name="description" content="O LivroNet conecta pessoas para trocar, doar e vender livros usados, dando mais vida útil aos livros e facilitando o acesso ao conhecimento.">

<link rel="icon" type="image/png" href="{{ asset('images/livronet_logo_horizontal.png') }}">

{{-- Open Graph: como o link costuma ser compartilhado em grupos de WhatsApp/Telegram,
     essas tags controlam a prévia (título, descrição e imagem) que aparece lá. --}}
<meta property="og:type" content="website">
<meta property="og:title" content="LivroNet - Troque, Doe e Reutilize Livros">
<meta property="og:description" content="Uma plataforma colaborativa para conectar pessoas, promover o reuso de livros e democratizar o acesso ao conhecimento.">
<meta property="og:image" content="{{ asset('images/livronet_logo_horizontal.png') }}">
<meta property="og:url" content="{{ url('/') }}">
<meta name="twitter:card" content="summary_large_image">

<style>

body{
    margin:0;
    font-family:Arial,Helvetica,sans-serif;
    background:#f8fafc;
    color:#2d3748;
}

header{

    background:linear-gradient(135deg,#003f9e,#3bb11d);
    color:white;
    text-align:center;
    padding:60px 20px;

}

header img{

    max-width:420px;
    width:90%;
}

header h1{

    font-size:42px;
    margin:20px 0 10px;

}

header p{

    font-size:22px;
    font-weight:300;

}

.botao{

display:inline-block;
padding:16px 30px;
margin-top:25px;
background:white;
color:#003f9e;
font-weight:bold;
text-decoration:none;
border-radius:40px;
transition:.3s;

}

.botao:hover{

transform:scale(1.05);

}

section{

max-width:1100px;
margin:auto;
padding:70px 20px;

}

h2{

color:#003f9e;
font-size:34px;

}

p{

line-height:1.8;
font-size:18px;

}

.cards{

display:grid;
grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
gap:25px;
margin-top:40px;

}

.card{

background:white;
padding:30px;
border-radius:16px;
box-shadow:0 5px 20px rgba(0,0,0,.08);

}

.card h3{

color:#3bb11d;

}

.apoio{

background:#003f9e;
color:white;
text-align:center;

}

.apoio h2{

color:white;

}

footer{

background:#17324f;
color:white;
text-align:center;
padding:40px;

}

footer a{

color:white;

}

footer .links{

margin-top:16px;
font-size:15px;

}

</style>

</head>

<body>

<header>

<img src="{{ asset('images/livronet_logo_horizontal.png') }}" alt="LivroNet">

<h1>Troque. Doe. Reutilize Livros.</h1>

<p>
Uma plataforma colaborativa para conectar pessoas,
promover o reuso de livros e democratizar o acesso ao conhecimento.
</p>

<a class="botao" href="https://play.google.com/store/apps/details?id=br.com.livronet.app" target="_blank" rel="noopener">
Disponível na Google Play
</a>

</header>

<section>

<h2>📚 O que é o LivroNet?</h2>

<p>

O LivroNet nasceu para incentivar o compartilhamento de livros entre pessoas.
Através do aplicativo é possível anunciar livros para troca, doação ou venda,
fazendo com que obras que estavam esquecidas em estantes encontrem novos leitores.

Mais do que um marketplace, o LivroNet é uma ferramenta de economia colaborativa
que combate o desperdício e amplia o acesso ao conhecimento.

</p>

</section>

<section>

<h2>🌎 Nossa Missão</h2>

<p>

Acreditamos que todo livro merece continuar sua história.

Cada livro reutilizado representa menos desperdício,
menos consumo de recursos naturais
e mais oportunidades para estudantes, professores e leitores.

Nosso objetivo é criar uma comunidade onde o conhecimento possa circular livremente.

</p>

</section>

<section>

<h2>✨ Por que utilizar o LivroNet?</h2>

<div class="cards">

<div class="card">

<h3>♻ Sustentabilidade</h3>

<p>
Estimula o reuso de livros e reduz o descarte desnecessário.
</p>

</div>

<div class="card">

<h3>📖 Democratização</h3>

<p>
Facilita o acesso a livros didáticos e obras literárias.
</p>

</div>

<div class="card">

<h3>🤝 Economia Colaborativa</h3>

<p>
Conecta pessoas interessadas em compartilhar conhecimento.
</p>

</div>

<div class="card">

<h3>🎓 Educação</h3>

<p>
Ajuda estudantes a obter materiais com menor custo.
</p>

</div>

</div>

</section>

<section class="apoio">

<h2>❤️ Ajude o LivroNet a continuar crescendo</h2>

{!! $content->why_we_ask_text !!}

<a class="botao" href="{{ route('apoie') }}">
Ver formas de apoiar
</a>

</section>

<section>

<h2>🌍 Contribuição para a Agenda 2030</h2>

<p>

O LivroNet contribui diretamente para os Objetivos de Desenvolvimento Sustentável (ODS) da ONU,
especialmente:

</p>

<ul>

<li>ODS 4 – Educação de Qualidade</li>

<li>ODS 12 – Consumo e Produção Responsáveis</li>

<li>ODS 13 – Ação Contra a Mudança Global do Clima</li>

<li>ODS 17 – Parcerias para Implementação dos Objetivos</li>

</ul>

<p>

Ao prolongar o ciclo de vida dos livros e incentivar sua circulação,
o LivroNet promove um modelo de consumo mais consciente e sustentável.

</p>

</section>

<footer>

<strong>LivroNet</strong><br><br>

Troque • Doe • Venda • Reutilize Livros<br><br>

Transformando livros esquecidos em novas oportunidades de aprendizado.

<div class="links">
<a href="{{ route('apoie') }}">Apoie o projeto</a>
&nbsp;•&nbsp;
<a href="{{ route('legal.privacy-policy') }}">Política de Privacidade</a>
</div>

</footer>

</body>
</html>
