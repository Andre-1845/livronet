@extends('emails.layout')

@section('subject', 'Redefinição de senha — LivroNet')

@section('content')
<p style="margin-top:0;">Olá{{ $userName ? ', '.$userName : '' }}!</p>

<p>Recebemos uma solicitação para redefinir a senha da sua conta no LivroNet.</p>

@include('emails.partials.button', ['url' => $resetUrl, 'text' => 'Redefinir senha'])

<p>Este link expira em {{ $expireMinutes }} minutos.</p>

<p style="color:#64748b; font-size:14px;">Se você não solicitou isso, pode ignorar este e-mail — sua senha continua a mesma.</p>
@endsection
