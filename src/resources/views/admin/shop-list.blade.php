@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
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
        <div class="shop-card" data-area-id="{{ $shop->area->id }}" data-genre-id="{{ $shop->genre->id }}">
            <form class="shop-card__form" action="/detail/{{ $shop->id }}" method="get">
                @csrf
                <div class="shop-card__img">
                    <img class="shop-card__img" src="{{ asset($shop->image) }}" alt="{{ $shop->shop_name }}">
                </div>
                <div class="shop-card__txt">
                    <h3 class="shop-card__shop-name">{{ $shop->shop_name }}</h3>
                    <div class="shop-card__txt-flex">
                        <p class="shop-card__area">#{{ $shop->area->area_name }}</p>
                        <p class="shop-card_genre">#{{ $shop->genre->genre_name }}</p>
                    </div>
                </div>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection