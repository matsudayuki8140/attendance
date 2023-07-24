@extends('layouts.app')

@section('title')
<title>Atte - ホーム</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<h2 class="content-title"><a href="/users/attendance?userId={{ $user['id'] }}" class="users-link">{{ $user['name'] }}</a>さんお疲れ様です！</h2>
<div class="button-top">
    @if($status === "private")
    <!-- 勤務開始ボタン　有効 -->
    <form action="/workStart" method="get" class="work-start button">
        @csrf
        <button class="work-start__button valid-button">勤務開始</button>
    </form>
    @else
    <!-- 勤務開始ボタン　無効 -->
    <div class="button">
        <span class="invalid-button">勤務開始</span>
    </div>
    @endif

    @if($status === "work")
    <!-- 勤務終了ボタン　有効 -->
    <form action="/workEnd" method="get" class="work-end button">
        @csrf
        <button class="work-end__button valid-button">勤務終了</button>
    </form>
    @else
    <!-- 勤務終了ボタン　無効 -->
    <div class="button">
        <span class="invalid-button">勤務終了</span>
    </div>
    @endif
</div>
<div class="button-bottom">
    @if($status === "work")
    <!-- 休憩開始ボタン　有効 -->
    <form action="/breakStart" method="get" class="break-start button">
        @csrf
        <button class="work-start__button valid-button">休憩開始</button>
    </form>
    @else
    <!-- 休憩開始ボタン　無効 -->
    <div class="button">
        <span class="invalid-button">休憩開始</span>
    </div>
    @endif

    @if($status === "break")
    <!-- 休憩終了ボタン　有効 -->
    <form action="/breakEnd" method="get" class="break-end button">
        @csrf
        <button class="break-end valid-button">休憩終了</button>
    </form>
    @else
    <!-- 休憩終了ボタン　無効 -->
    <div class="button">
        <span class="invalid-button">休憩終了</span>
    </div>
    @endif
</div>
@endsection