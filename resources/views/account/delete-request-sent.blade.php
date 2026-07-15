<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LivroNet - Verifique seu e-mail</title>

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

    .logo img {
        max-width: 420px;
        width: 100%;
        margin-bottom: 30px;
    }

    .icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 25px;
        border-radius: 50%;
        background: #eef4ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
    }

    h1 {
        color: #003f9e;
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
        font-size: 20px;
        line-height: 1.8;
        color: #334155;
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

        <div class="icon">
            ✉️
        </div>

        <h1>Verifique seu e-mail</h1>

        <div class="divider"></div>

        <div class="message">
            Se existir uma conta LivroNet com o e-mail informado,
            enviamos um link para confirmar a exclusão.

            <br><br>

            O link expira em 30 minutos. Se não encontrar o e-mail,
            confira também a caixa de spam.
        </div>

    </div>

</div>

<div class="footer">
    Troque, doe e <span>reutilize livros.</span>
</div>

</body>
</html>
