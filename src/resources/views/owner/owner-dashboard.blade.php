@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner-dashboard.css') }}">
@endsection

@section('content')
<div class="content-are">
    @if(session('success'))
    <div class="alert alert-success" id="success-message">
        {{ session('success') }}
    </div>
    @endif

    <h3 class="login-user">{{ $user->name }} さん お疲れ様です！</h3>
    <div class="flex">
        <div class="left">
            <form action="{{ route('owner.shop-register') }}" method="get">
                <button class="register__btn" type="submit">店舗新規作成</button>
            </form>
        </div>
        <div class="right">
            <h3 class="section">管理店舗一覧</h3>
            <div class="header-shop">
                <label for="shop_name" class="header-label">店舗名</label>
                <label for="shop_update" class="header-label">店舗情報</label>
                <label for="shop_reserve" class="header-label">予約情報</label>
            </div>
            @foreach($shops as $shop)
            <div class="shop-content">
                <p class="shop_name-input">{{ $shop->shop_name }}</p>
                <form class="btn-form" action="{{ route('owner.shop-update', ['id' => $shop->id]) }}" method="get">
                    <button class="shop-update__btn" type="submit">更新</button>
                </form>
                <form class="btn-form" action="{{ route('owner.reserved', ['id' => $shop->id]) }}" method="get">
                    <button class="shop-reserved__btn" type="submit">確認</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    window.onload = function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 3000);
        }
    };
</script>
@endsection