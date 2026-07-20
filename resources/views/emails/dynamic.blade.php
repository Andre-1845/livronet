@extends('emails.layout')

@section('subject', $subject)

@section('content')
{!! $body !!}

@include('emails.partials.button', ['url' => $actionUrl, 'text' => $buttonText])

@if($closingText)
<p style="color:#64748b; font-size:14px;">{!! $closingText !!}</p>
@endif
@endsection
