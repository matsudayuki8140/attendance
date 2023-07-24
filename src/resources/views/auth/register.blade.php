@extends('layouts.app')

@section('title')
<title>Atte - 会員登録</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<h2 class="content-title">会員登録</h2>
<form action="/register" method="post" class="register-form">
    @csrf
    <input type="text" name="name" class="register-form__input" placeholder="名前" value="{{ old('name') }}">
    @error('name')
    <p class="error-message">{{ $message }}</p>
    @enderror
    <input type="text" name="email" class="register-form__input" placeholder="メールアドレス" value="{{ old('email') }}">
    @error('email')
    <p class="error-message">{{ $message }}</p>
    @enderror
    <input type="password" name="password" class="register-form__input" placeholder="パスワード">
    @error('password')
    <p class="error-message">{{ $message }}</p>
    @enderror
    <input type="password" name="password_confirmation" class="register-form__input" placeholder="確認用パスワード">
    @error('password_confirmation')
    <p class="error-message">{{ $message }}</p>
    @enderror
    <button class="register-form__button">会員登録</button>
</form>
<div class="lead">
    <p class="lead-text">アカウントをお持ちの方はこちらから</p>
    <a href="login" class="lead-link">ログイン</a>
</div>
@endsection