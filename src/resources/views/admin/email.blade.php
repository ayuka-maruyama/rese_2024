@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reserve.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin-email.css') }}">
@endsection

@section('content')
<div class="back">
    <form class="shop-detail__form" action="{{ route('admin.dashboard') }}" method="get">
        <button class="back-btn" type="submit">&lt;</button>
        <span class="message">戻る</span>
    </form>
</div>
<div class="mail-input_area">
    <form action="{{ route('admin.sendEmail') }}" method="POST">
        @csrf
        <div class="mail-content">
            <table class="table-area">
                <tr class="table-row">
                    <th class="table-header">送信先</th>
                    <td class="table-data mail">登録されているユーザー全員</td>
                </tr>
                <tr class="table-row">
                    <th class="table-header">件名</th>
                    <td class="table-data">
                        <input type="text" name="subject" id="subject" required>
                    </td>
                </tr>
                <tr class="table-row">
                    <th class="table-header">本文</th>
                    <td class="table-data">
                        <textarea name="body" id="body" required></textarea>
                    </td>
                </tr>
            </table>
            <div class="btn-area">
                <button class="btn" type="submit">メールを送信</button>
            </div>
        </div>
    </form>
</div>
@endsection