@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner-dashboard.css') }}">
@endsection

@section('content')
<div class="content-are">
    <h3 class="login-user">{{ $user->name }} さん お疲れ様です！</h3>
    <div class="flex">
        <div class="left">
            <form action="" method="get">
                <button class="register__btn" type="submit">店舗新規作成</button>
            </form>
        </div>
        <div class="right">
            <h3 class="section">管理店舗一覧</h3>
            <table class="table-area">
                <tr class="table-row">
                    <th class="table-header__left">店舗名</th>
                    <th class="table-header__right"></th>
                </tr>
                @foreach($shops as $shop)
                <tr class="table-row">
                    <td class="table-data__left">{{ $shop->shop_name }}</td>
                    <td class="table-data__right">
                        <button class="detail-btn" type="submit">詳細</button>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection