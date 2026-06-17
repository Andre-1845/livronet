<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LivroNet - E-mail Confirmado</title>

```
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

    .success-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 25px;
        border-radius: 50%;
        background: #e8f8ea;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: #3bb11d;
    }

    h1 {
        color: #003f9e;
        font-size: 38px;
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
        font-size: 22px;
        line-height: 1.8;
        color: #334155;
    }

    .message strong {
        color: #003f9e;
    }

    .btn {
        display: inline-block;
        margin-top: 35px;
        padding: 16px 36px;
        background: #003f9e;
        color: white;
        text-decoration: none;
        border-radius: 12px;
        font-size: 18px;
        font-weight: bold;
        transition: .2s;
    }

    .btn:hover {
        background: #002f76;
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

    @media (max-width: 768px) {

        .card {
            padding: 35px 25px;
        }

        h1 {
            font-size: 30px;
        }

        .message {
            font-size: 18px;
        }

        .logo img {
            max-width: 280px;
        }
    }
</style>
```

</head>

<body>

```
<div class="container">

    <div class="card">

        <div class="logo">

            {{-- Opção 1: logo hospedada no Laravel --}}
            <img src="{{ asset('images/livronet_logo_horizontal.png') }}"
                 alt="LivroNet">


        </div>

        <div class="success-icon">
            ✓
        </div>

        <h1>E-mail confirmado com sucesso!</h1>

        <div class="divider"></div>

        <div class="message">

            Sua conta foi validada com sucesso.

            <br><br>

            Agora você já pode acessar o aplicativo
            <strong>LivroNet</strong> e aproveitar todos os recursos da plataforma.

        </div>

        {{-- <a href="https://livronet.org"
           class="btn">


            Voltar ao LivroNet

        </a> --}}

    </div>

</div>

<div class="footer">
    Troque, doe e <span>reutilize livros.</span>
</div>
```

</body>

</html>
