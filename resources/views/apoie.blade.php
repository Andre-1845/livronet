<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LivroNet - Apoie o Projeto</title>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        background: #f7f9fc;
        min-height: 100vh;
        color: #1e293b;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
        padding: 40px 30px;
    }

    .card {
        background: #ffffff;
        border-radius: 24px;
        padding: 50px;
        box-shadow:
            0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .logo {
        text-align: center;
        margin-bottom: 30px;
    }

    .logo img {
        max-width: 320px;
        width: 100%;
        height: auto;
    }

    h1 {
        color: #003f9e;
        font-size: 32px;
        margin-bottom: 8px;
        text-align: center;
    }

    .subtitle {
        text-align: center;
        color: #64748b;
        font-size: 16px;
        margin-bottom: 30px;
    }

    .divider {
        width: 140px;
        height: 4px;
        background: #3bb11d;
        border-radius: 20px;
        margin: 0 auto 35px;
    }

    h2 {
        color: #003f9e;
        font-size: 20px;
        margin-top: 32px;
        margin-bottom: 12px;
    }

    p, li {
        font-size: 16px;
        line-height: 1.7;
        color: #334155;
    }

    ul {
        margin: 10px 0 10px 20px;
    }

    li {
        margin-bottom: 6px;
    }

    .highlight-box {
        background: #eef4ff;
        border-left: 4px solid #003f9e;
        padding: 16px 20px;
        border-radius: 8px;
        margin: 20px 0;
    }

    .support-options {
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        margin: 20px 0 10px;
    }

    .support-card {
        flex: 1 1 220px;
        background: #f7f9fc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 22px;
        text-align: center;
    }

    .support-card h3 {
        color: #003f9e;
        font-size: 17px;
        margin-bottom: 8px;
    }

    .support-card p {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 16px;
    }

    .btn {
        display: inline-block;
        background: #003f9e;
        color: #ffffff !important;
        text-decoration: none;
        font-weight: bold;
        font-size: 15px;
        padding: 12px 22px;
        border-radius: 10px;
    }

    .btn.green {
        background: #3bb11d;
    }

    .pix-key-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        background: #ffffff;
        border: 1px dashed #003f9e;
        border-radius: 10px;
        padding: 12px 16px;
        margin-top: 10px;
        font-family: monospace;
        font-size: 15px;
        color: #003f9e;
        word-break: break-all;
    }

    .footer {
        text-align: center;
        padding: 25px;
        color: #003f9e;
        font-size: 16px;
    }

    .footer span {
        color: #3bb11d;
        font-weight: bold;
    }

    a {
        color: #003f9e;
    }
</style>

</head>

<body>

<div class="container">

    <div class="card">

        <div class="logo">
            <img src="{{ asset('images/livronet_logo_horizontal.png') }}"
                 alt="LivroNet">
        </div>

        <h1>{{ $content->title }}</h1>
        <div class="subtitle">{{ $content->subtitle }}</div>

        <div class="divider"></div>

        {!! $content->intro_text !!}

        @if($content->why_it_exists_text)
            <h2>Por que o projeto existe</h2>
            {!! $content->why_it_exists_text !!}
        @endif

        @if($content->why_we_ask_text)
            <h2>Por que pedimos apoio</h2>
            {!! $content->why_we_ask_text !!}
        @endif

        <div class="highlight-box">
            A doação é <strong>100% opcional</strong> e não cria
            nenhum privilégio: não desbloqueia funcionalidades, não dá
            destaque a anúncios, não muda em nada a experiência de quem
            doa ou de quem não doa. Apoiar é só uma forma de dizer
            "esse projeto vale a pena continuar existindo".
        </div>

        @if($content->pix_key || $content->livepix_url || $content->apoiase_url)
            <h2>Como apoiar</h2>
            <p>
                Escolha a forma que preferir. Qualquer valor ajuda.
            </p>

            <div class="support-options">

                @if($content->pix_key)
                    <div class="support-card">
                        <h3>Pix</h3>
                        <p>Doação direta, sem taxas de intermediário.</p>
                        <div class="pix-key-box">
                            {{ $content->pix_key }}
                        </div>
                    </div>
                @endif

                @if($content->livepix_url)
                    <div class="support-card">
                        <h3>Livepix</h3>
                        <p>Doação rápida via cartão ou Pix, com recibo automático.</p>
                        <a class="btn" href="{{ $content->livepix_url }}" target="_blank" rel="noopener">
                            Doar pelo Livepix
                        </a>
                    </div>
                @endif

                @if($content->apoiase_url)
                    <div class="support-card">
                        <h3>Apoia.se</h3>
                        <p>Apoio recorrente mensal, se preferir contribuir sempre.</p>
                        <a class="btn green" href="{{ $content->apoiase_url }}" target="_blank" rel="noopener">
                            Apoiar no Apoia.se
                        </a>
                    </div>
                @endif

            </div>
        @endif

        @if($content->transparency_text)
            <h2>Transparência</h2>
            {!! $content->transparency_text !!}
        @endif

        <h2>Dúvidas</h2>
        <p>
            Qualquer pergunta sobre o projeto ou sobre as formas de
            apoio pode ser enviada para:
            <strong><a href="mailto:{{ $content->contact_email }}">{{ $content->contact_email }}</a></strong>
        </p>

    </div>

</div>

<div class="footer">
    Troque, doe e <span>reutilize livros.</span>
</div>

</body>
</html>
