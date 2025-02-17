@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reserve.css') }}">
<link rel="stylesheet" href="{{ asset('css/owner-shoplist.css') }}">
@endsection

@section('content')
<div class="shop-list">
    <h3 class="login-owner">{{ $user->name }} さんが管理している店舗一覧</h3>
    <form class="shop-detail__form" action="{{ route('admin.dashboard') }}" method="get">
        <button class="back-btn" type="submit">&lt;</button>
        <span class="message">戻る</span>
    </form>
    <div class="shop-card__wrap">
        @foreach($shops as $shop)
            @include('partials.shop-card', ['shop' => $shop,'favoriteShopIds' => []])
        @endforeach
    </div>
</div>
@endsection