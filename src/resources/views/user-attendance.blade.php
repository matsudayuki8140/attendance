@extends('layouts.app')

@section('title')
<title>Atte - {{ $user['name'] }}さん</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/user-attendance.css') }}">
@endsection

@section('content')
<div class="content-title">
    <form action="/users/attendance/before" method="get">
        @csrf
        <input type="hidden" name="userId" value="{{ $user['id'] }}">
        @if($user['id'] === 1)
            <span class="invalid-button">＜</span>
        @else
            <button class="user-before">＜</button>
        @endif
    </form>
    <h2 class="name">{{ $user['name'] }}</h2>
    <form action="/users/attendance/after" method="get">
        @csrf
        <input type="hidden" name="userId" value="{{ $user['id'] }}">
        <button class="user-after">＞</button>
    </form>
</div>
<table class="user-table">
    <tr class="user-list">
        <th class="user-title" scope="col">日付</th>
        <th class="user-title" scope="col">勤務開始</th>
        <th class="user-title" scope="col">勤務終了</th>
        <th class="user-title" scope="col">休憩時間</th>
        <th class="user-title" scope="col">勤務時間</th>
    </tr>
    @foreach($attendances as $attendance)
    <tr class="user-list">
        <td class="user-item">{{ $attendance['date'] }}</td>
        <td class="user-item">{{ $attendance['start'] }}</td>
        <td class="user-item">{{ $attendance['end'] }}</td>
        <td class="user-item">{{ $attendance['break'] }}</td>
        <td class="user-item">{{ $attendance['total'] }}</td>
    </tr>
    @endforeach
</table>
<div class="paginate">{{ $attendances->appends(['userId' => $user['id']])->links() }}</div>
@endsection