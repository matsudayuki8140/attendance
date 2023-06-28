@extends('layouts.app')

@section('title')
<title>Atte - 日付一覧</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection

@section('content')
<div class="paginate-title"></div>
<table class="date-table">
    <tr class="date-list">
        <th class="date-title">名前</th>
        <th class="date-title">勤務開始</th>
        <th class="date-title">勤務終了</th>
        <th class="date-title">休憩時間</th>
        <th class="date-title">勤務時間</th>
    </tr>
    <!-- ここからサンプル----------------------------------- -->
    <tr class="date-list">
        <td class="date-item">sample</td>
        <td class="date-item">10:00:00</td>
        <td class="date-item">20:00:00</td>
        <td class="date-item">00:30:00</td>
        <td class="date-item">09:30:00</td>
    </tr>
    <tr class="date-list">
        <td class="date-item">sample</td>
        <td class="date-item">10:00:00</td>
        <td class="date-item">20:00:00</td>
        <td class="date-item">00:30:00</td>
        <td class="date-item">09:30:00</td>
    </tr>
    <tr class="date-list">
        <td class="date-item">sample</td>
        <td class="date-item">10:00:00</td>
        <td class="date-item">20:00:00</td>
        <td class="date-item">00:30:00</td>
        <td class="date-item">09:30:00</td>
    </tr>
    <tr class="date-list">
        <td class="date-item">sample</td>
        <td class="date-item">10:00:00</td>
        <td class="date-item">20:00:00</td>
        <td class="date-item">00:30:00</td>
        <td class="date-item">09:30:00</td>
    </tr>
    <tr class="date-list">
        <td class="date-item">sample</td>
        <td class="date-item">10:00:00</td>
        <td class="date-item">20:00:00</td>
        <td class="date-item">00:30:00</td>
        <td class="date-item">09:30:00</td>
    </tr>
    <!-- ここまでサンプル---------------------------------- -->
</table>
<div class="paginate"></div>
@endsection