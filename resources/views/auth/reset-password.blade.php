<!DOCTYPE html>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LivroNet - Redefinir Senha</title>

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

    .lock-icon {
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
        font-size: 20px;
        line-height: 1.7;
        color: #334155;
        margin-bottom: 30px;
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
        background: #003f9e;
        color: white;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn:hover {
        background: #002f76;
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
```

</head>

<body>

<div class="container">

```
<div class="card">

    <div class="logo">
        <img src="{{ asset('images/livronet_logo_horizontal.png') }}"
             alt="LivroNet">
    </div>

    <div class="lock-icon">
        🔒
    </div>

    <h1>Redefinir Senha</h1>

    <div class="divider"></div>

    <div class="message">
        Informe sua nova senha para continuar utilizando o LivroNet.
    </div>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ url('/reset-password') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">

        <div class="form-group">
            <label>Nova senha</label>
            <input
                type="password"
                name="password"
                required>
        </div>

        <div class="form-group">
            <label>Confirmar senha</label>
            <input
                type="password"
                name="password_confirmation"
                required>
        </div>

        <button type="submit" class="btn">
            Salvar Nova Senha
        </button>

    </form>

</div>
```

</div>

<div class="footer">
    Troque, doe e <span>reutilize livros.</span>
</div>

</body>
</html>
