{{-- Botão de ação padrão dos e-mails. Uso: @include('emails.partials.button', ['url' => $url, 'text' => 'Texto do botão']) --}}
<table role="presentation" cellpadding="0" cellspacing="0" style="margin: 28px 0;">
    <tr>
        <td style="border-radius:10px; background-color:#003f9e;">
            <a href="{{ $url }}"
               target="_blank"
               style="display:inline-block; padding:14px 28px; font-size:15px; font-weight:bold; color:#ffffff; text-decoration:none; border-radius:10px;">
                {{ $text }}
            </a>
        </td>
    </tr>
</table>
