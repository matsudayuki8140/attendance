@extends('layouts.app')

@section('title')
<title>Atte - ホーム</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<h2 class="content-title">()さんお疲れ様です！</h2>
<div class="button-top">
    <!-- 勤務開始ボタン　有効 -->
    <form action="/workStart" class="work-start button">
        <button class="work-start__button valid-button">勤務開始</button>
    </form>
    <!-- 勤務終了ボタン　無効 -->
    <div class="button">
        <span class="invalid-button">勤務終了</span>
    </div>
</div>
<div class="button-bottom">
    <!-- 休憩開始ボタン　無効 -->
    <div class="button">
        <span class="invalid-button">休憩開始</span>
    </div>
    <!-- 休憩終了ボタン　無効 -->
    <div class="button">
        <span class="invalid-button">休憩終了</span>
    </div>
</div>
@endsection