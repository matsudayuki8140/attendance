@extends('layouts.app')

@section('title')
<title>Atte - 認証用メールを送信しました</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/verify.css') }}">
@endsection

@section('content')
<h2 class="content-title">認証用メールを送信しました</h2>
<div class="lead">
    <p class="lead-text">
        届いたメールに記載されたリンクをクリックして、会員登録を完了してください。
    </p>
    <p class="lead-text">
        ※メールが届かない場合は、入力したアドレスに間違いがあるか、<br>あるいは迷惑メールフォルダに入っている可能性がありますのでご確認ください。
    </p>
</div>
@if (session('status') == 'verification-link-sent')
    <p class="resend-text">
        認証用メールを再送信しました。
    </p>
@endif

<div class="mail-resend">
    <p class="lead-text">
        認証メールを再送する場合はボタンをクリックしてください。
    </p>
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="resend-button">メールを再送信する</button>
    </form>
</div>
@endsection