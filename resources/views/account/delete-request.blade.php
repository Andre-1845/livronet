<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LivroNet - Excluir Conta</title>

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
        display: flex;
        flex-direction: column;
        color: #1e293b;
    }

    .container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 30px;
    }

    .card {
        width: 100%;
        max-width: 700px;
        background: #ffffff;
        border-radius: 24px;
        padding: 50px;
        text-align: center;
        box-shadow:
            0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .logo {
        margin-bottom: 30px;
    }

    .logo img {
        max-width: 420px;
        width: 100%;
        height: auto;
    }

    .warn-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 25px;
        border-radius: 50%;
        background: #fdecec;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
    }

    h1 {
        color: #003f9e;
        font-size: 34px;
        margin-bottom: 20px;
    }

    .divider {
        width: 140px;
        height: 4px;
        background: #3bb11d;
        border-radius: 20px;
        margin: 0 auto 35px;
    }

    .message {
        font-size: 18px;
        line-height: 1.7;
        color: #334155;
        margin-bottom: 20px;
        text-align: left;
    }

    .message ul {
        margin: 12px 0 12px 20px;
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #003f9e;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 14px;
        border: 1px solid #dbe2ea;
        border-radius: 12px;
        font-size: 16px;
    }

    .btn {
        width: 100%;
        padding: 16px;
        border: none;
        border-radius: 12px;
        background: #b91c1c;
        color: white;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn:hover {
        background: #8f1616;
    }

    .error {
        background: #fdecec;
        color: #b91c1c;
        padding: 12px;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    .footer {
        text-align: center;
        padding: 25px;
        color: #003f9e;
        font-size: 18px;
    }

    .footer span {
        color: #3bb11d;
        font-weight: bold;
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

        <div class="warn-icon">
            ⚠️
        </div>

        <h1>Excluir minha conta</h1>

        <div class="divider"></div>

        <div class="message">
            Ao confirmar, sua conta no LivroNet será excluída:
            <ul>
                <li>Seu nome, e-mail, telefone e demais dados pessoais são removidos.</li>
                <li>Seus livros anunciados saem da vitrine permanentemente.</li>
                <li>Conversas com outras pessoas continuam existindo para elas, mas seu nome aparecerá como "Usuário removido".</li>
            </ul>
            Essa ação não pode ser desfeita. Informe o e-mail da conta para receber um link de confirmação.
        </div>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ url('/account/delete') }}">
            @csrf

            <div class="form-group">
                <label>E-mail da conta</label>
                <input
                    type="email"
                    name="email"
                    required>
            </div>

            <button type="submit" class="btn">
                Enviar link de confirmação
            </button>

        </form>

    </div>

</div>

<div class="footer">
    Troque, doe e <span>reutilize livros.</span>
</div>

</body>
</html>
