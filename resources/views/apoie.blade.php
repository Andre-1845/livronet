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

        <h1>Apoie o LivroNet</h1>
        <div class="subtitle">Sua doação é opcional, mas faz diferença.</div>

        <div class="divider"></div>

        <p>
            O <strong>LivroNet</strong> nasceu com um objetivo simples:
            fazer os livros circularem, em vez de ficarem parados numa
            estante depois que um estudante termina de usá-los. Cada
            livro doado, trocado ou repassado é um livro a menos
            comprado do zero, e um livro a mais chegando a quem precisa
            e talvez não pudesse pagar por ele.
        </p>

        <h2>Por que o projeto existe</h2>
        <p>
            Livros didáticos e acadêmicos são caros, e boa parte deles é
            usada por poucos meses antes de ir parar numa caixa
            esquecida. Ao mesmo tempo, tem sempre um outro estudante
            precisando exatamente daquele livro. O LivroNet aproxima
            essas duas pontas — sem cobrar comissão, sem intermediar
            pagamentos, sem transformar isso em negócio.
        </p>
        <p>
            É um projeto pensado para <strong>educação</strong>,
            <strong>economia</strong> no bolso de quem estuda e
            <strong>sustentabilidade</strong> — reduzir desperdício
            dando mais vida útil a algo que já existe.
        </p>

        <h2>Por que pedimos apoio</h2>
        <p>
            O LivroNet é mantido de forma independente, sem investidores
            e sem publicidade dentro do app. Os custos de servidor,
            domínio e manutenção saem do bolso de quem desenvolve o
            projeto. Doações voluntárias ajudam a manter o app no ar,
            gratuito e sem anúncios, para todos os estudantes que
            dependem dele.
        </p>

        <div class="highlight-box">
            A doação é <strong>100% opcional</strong> e não cria
            nenhum privilégio: não desbloqueia funcionalidades, não dá
            destaque a anúncios, não muda em nada a experiência de quem
            doa ou de quem não doa. Apoiar é só uma forma de dizer
            "esse projeto vale a pena continuar existindo".
        </div>

        <h2>Como apoiar</h2>
        <p>
            Escolha a forma que preferir. Qualquer valor ajuda.
        </p>

        <div class="support-options">
            <div class="support-card">
                <h3>Pix</h3>
                <p>Doação direta, sem taxas de intermediário.</p>
                <div class="pix-key-box">
                    {{-- TODO: substituir pela chave Pix real (e-mail, telefone ou chave aleatória) --}}
                    livronet.app@gmail.com
                </div>
            </div>

            <div class="support-card">
                <h3>Livepix</h3>
                <p>Doação rápida via cartão ou Pix, com recibo automático.</p>
                {{-- TODO: substituir pelo link real da página no Livepix --}}
                <a class="btn" href="https://livepix.gg/livronet" target="_blank" rel="noopener">
                    Doar pelo Livepix
                </a>
            </div>

            <div class="support-card">
                <h3>Apoia.se</h3>
                <p>Apoio recorrente mensal, se preferir contribuir sempre.</p>
                {{-- TODO: substituir pelo link real da página no Apoia.se --}}
                <a class="btn green" href="https://apoia.se/livronet" target="_blank" rel="noopener">
                    Apoiar no Apoia.se
                </a>
            </div>
        </div>

        <h2>Transparência</h2>
        <p>
            As doações recebidas são usadas exclusivamente para custear
            a infraestrutura do LivroNet (servidor, domínio e serviços
            associados) e sua manutenção contínua. O projeto não possui
            fins lucrativos e não repassa nem vende dados de quem doa
            ou de quem usa o app.
        </p>

        <h2>Dúvidas</h2>
        <p>
            Qualquer pergunta sobre o projeto ou sobre as formas de
            apoio pode ser enviada para:
            <strong><a href="mailto:livronet.app@gmail.com">livronet.app@gmail.com</a></strong>
        </p>

    </div>

</div>

<div class="footer">
    Troque, doe e <span>reutilize livros.</span>
</div>

</body>
</html>
