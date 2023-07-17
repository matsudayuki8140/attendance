@extends('layouts.app')

@section('title')
<title>Atte - ユーザー一覧</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/users.css') }}">
@endsection

@section('content')
<h2 class="content-title">ユーザー一覧</h2>
<table class="users-table">
    <tr class="users-list">
        <th class="users-title" scope="col">ID</th>
        <th class="users-title" scope="col">名前</th>
    </tr>
    @foreach($users as $user)
    <tr class="users-list">
        <td class="users-item">{{ $user['id'] }}</td>
        <td class="users-item"><a href="/users/attendance?userId={{ $user['id'] }}" class="users-link">{{ $user['name'] }}</a></td>
    </tr>
    @endforeach
</table>
<div class="paginate">{{ $users->links() }}</div>
@endsection