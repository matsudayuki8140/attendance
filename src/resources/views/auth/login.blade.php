@extends('layouts.app')

@section('title')
<title>Atte - ログイン</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<h2 class="content-title">ログイン</h2>
<form action="{{ route('login')  }}" method="post" class="login-form">
    @csrf
    <input type="text" name="email" class="login-form__input" placeholder="メールアドレス">
    <input type="text" name="password" class="login-form__input" placeholder="パスワード">
    <button class="login-form__button">ログイン</button>
</form>
<div class="lead">
    <p class="lead-text">アカウントをお持ちでない方はこちらから</p>
    <a href="register" class="lead-link">会員登録</a>
</div>
@endsection