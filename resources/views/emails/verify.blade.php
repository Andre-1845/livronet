@extends('emails.layout')

@section('subject', 'Confirme seu e-mail — LivroNet')

@section('content')
<p style="margin-top:0;">Olá{{ $userName ? ', '.$userName : '' }}!</p>

<p>Recebemos seu cadastro no LivroNet. Falta só confirmar seu e-mail para liberar o acesso completo ao app.</p>

@include('emails.partials.button', ['url' => $verificationUrl, 'text' => 'Confirmar e-mail'])

<p style="color:#64748b; font-size:14px;">Se você não criou uma conta no LivroNet, pode ignorar este e-mail — nada será feito.</p>
@endsection
