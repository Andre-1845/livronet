@extends('emails.layout')

@section('subject', 'Confirme a exclusão da sua conta — LivroNet')

@section('content')
<p style="margin-top:0;">Olá!</p>

<p>Recebemos um pedido para excluir sua conta no LivroNet.</p>

<p>Isso vai remover seus dados pessoais (nome, e-mail, telefone) e tirar seus livros da vitrine permanentemente.</p>

<p>Se foi você, confirme clicando no botão abaixo. Este link expira em 30 minutos.</p>

@include('emails.partials.button', ['url' => $confirmUrl, 'text' => 'Confirmar exclusão da conta'])

<p style="color:#64748b; font-size:14px;">Se você não pediu isso, pode ignorar este e-mail — nada será alterado na sua conta.</p>
@endsection
