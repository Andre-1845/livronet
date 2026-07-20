<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>@yield('subject', 'LivroNet')</title>
</head>
<body style="margin:0; padding:0; background-color:#f7f9fc; font-family: Arial, Helvetica, sans-serif;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f7f9fc;">
<tr>
<td align="center" style="padding: 32px 16px;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px;">

    {{-- Logo --}}
    <tr>
        <td align="center" style="padding-bottom: 24px;">
            <a href="https://livronet.org" style="text-decoration:none;">
                <img src="{{ asset('images/livronet_logo_horizontal.png') }}"
                     alt="LivroNet"
                     width="220"
                     style="display:block; border:0; outline:0; max-width:220px; width:100%; height:auto;">
            </a>
        </td>
    </tr>

    {{-- Cartão de conteúdo --}}
    <tr>
        <td style="background-color:#ffffff; border-radius:16px; padding:40px 32px;">
            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="color:#1e293b; font-size:16px; line-height:1.6;">
                        @yield('content')
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    {{-- Rodapé padronizado --}}
    <tr>
        <td align="center" style="padding-top: 28px; color:#64748b; font-size:13px; line-height:1.7;">
            Troque, doe e <strong style="color:#3bb11d;">reutilize livros.</strong>
            <br>
            &copy; {{ date('Y') }} LivroNet. Todos os direitos reservados.
            <br>
            Dúvidas? <a href="mailto:livronet.app@gmail.com" style="color:#003f9e; text-decoration:none;">livronet.app@gmail.com</a>
        </td>
    </tr>

</table>

</td>
</tr>
</table>

</body>
</html>
