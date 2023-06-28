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
    <form action="" class="work-start">
        <button class="work-start__button">勤務開始</button>
    </form>
    <!-- 勤務開始ボタン　無効 -->
    <div class="invalid-button">
        <span class="invalid-button__label">勤務開始</span>
    </div>

    <!-- 勤務終了ボタン　有効 -->
    <form action="" class="work-end">
        <button class="work-end__button">勤務終了</button>
    </form>
    <!-- 勤務終了ボタン　無効 -->
    <div class="invalid-button">
        <span class="invalid-button__label">勤務終了</span>
    </div>
</div>
<div class="button-bottom">
    <!-- 休憩開始ボタン　有効 -->
    <form action="" class="break-start">
        <button class="work-start__button">休憩開始</button>
    </form>
    <!-- 休憩開始ボタン　無効 -->
    <div class="invalid-button">
        <span class="invalid-button__label">休憩開始</span>
    </div>
    <!-- 休憩終了ボタン　有効 -->
    <form action="" class="break-end">
        <button class="break-end">休憩終了</button>
    </form>
    <!-- 休憩終了ボタン　無効 -->
    <div class="invalid-button">
        <span class="invalid-button__label">休憩終了</span>
    </div>
</div>
@endsection