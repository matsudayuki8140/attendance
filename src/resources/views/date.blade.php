@extends('layouts.app')

@section('title')
<title>Atte - 日付一覧</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/date.css') }}">
@endsection

@section('content')
<div class="content-title">
    <form action="/attendance/before" method="post">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">
        <button class="day-before">＜</button>
    </form>
    <h2 class="date">{{ $date }}</h2>
    <form action="/attendance/after" method="post">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">
        <button class="day-after">＞</button>
    </form>
</div>
<table class="date-table">
    <tr class="date-list">
        <th class="date-title" scope="col">名前</th>
        <th class="date-title" scope="col">勤務開始</th>
        <th class="date-title" scope="col">勤務終了</th>
        <th class="date-title" scope="col">休憩時間</th>
        <th class="date-title" scope="col">勤務時間</th>
    </tr>
    @foreach($attendances as $attendance)
    <tr class="date-list">
        <td class="date-item">{{ $attendance['name'] }}</td>
        <td class="date-item">{{ $attendance['start'] }}</td>
        <td class="date-item">{{ $attendance['end'] }}</td>
        <td class="date-item">{{ $attendance['break'] }}</td>
        <td class="date-item">{{ $attendance['total'] }}</td>
    </tr>
    @endforeach
</table>
<div class="paginate">{{ $attendances->links() }}</div>
@endsection