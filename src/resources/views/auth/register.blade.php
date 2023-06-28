@extends('layouts.app')

@section('title')
<title>Atte - 会員登録</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<h2 class="content-title">会員登録</h2>
<form action="post" class="register-form">
    <input type="text" class="register-form__input" placeholder="名前">
    <input type="text" class="register-form__input" placeholder="メールアドレス">
    <input type="text" class="register-form__input" placeholder="パスワード">
    <input type="text" class="register-form__input" placeholder="確認用パスワード">
    <button class="register-form__button">会員登録</button>
</form>
<div class="lead">
    <p class="lead-text">アカウントをお持ちの方はこちらから</p>
    <a href="login" class="lead-link">ログイン</a>
</div>
@endsection