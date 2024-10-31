@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reserve.css') }}">
<link rel="stylesheet" href="{{ asset('css/owner-update.css') }}">
@endsection

@section('content')
<form class="shop-detail__form" action="{{ route('admin.dashboard') }}" method="get">
    <button class="back-btn" type="submit">&lt;</button>
    <span class="message">戻る</span>
</form>
<div class="update-area">
    <form action="{{ route('admin.owner-update', ['id' => $request->id]) }}" method="post">
        @csrf
        <table>
            <tr class="table-row">
                <th class="table-header">店舗管理者名</th>
                <td class="table-date">
                    <input class="input-area" type="text" name="name" value="{{ $request->name }}">
                </td>
            </tr>
            <tr class="table-row">
                <th class="table-header">メールアドレス</th>
                <td class="table-date">
                    <input class="input-area" type="text" name="email" value="{{ $request->email }}">
                </td>
            </tr>
            <tr class="table-row">
                <th class="table-header">パスワード</th>
                <td class="table-date">
                    @if($request->password)
                    <input class="input-area" type="text" name="password" value="">
                    @endif
                </td>
            </tr>
            <tr class="table-row">
                <th class="table-header"></th>
                <td class="table-date__btn">
                    <button class="update-btn" type="submit">更新</button>
                </td>
            </tr>
        </table>
    </form>
    @if ($errors->any())
    <div class="error-index">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endsection