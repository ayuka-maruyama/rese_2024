@extends('layouts.app')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection

@section('header')
<div class="search">
    <form id="search-form" action="{{ route('shop.search') }}" method="post">
        @csrf
        <select class="search-form__item-select" name="area" id="area">
            <option value="all" selected>All area</option>
            @foreach($areas as $area)
            <option value="{{ $area->id }}">{{ $area->area_name }}</option>
            @endforeach
        </select>
        <select class="search-form__item-select" name="genre" id="genre">
            <option value="all" selected>All genre</option>
            @foreach($genres as $genre)
            <option value="{{ $genre->id }}">{{ $genre->genre_name }}</option>
            @endforeach
        </select>
        <input class="search-form__item-input" type="text" name="shop_name" placeholder="Search ..." id="shop-name">
    </form>
    <div id="shop-results"></div>
</div>
@endsection

@section('content')
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
                <div class="shop-card__btn">
                    <button class="btn-submit" type="submit">詳しくみる</button>
                    <button class="favorite-btn {{ in_array($shop->id, $favoriteShopIds) ? 'favorited' : '' }}" data-id="{{ $shop->id }}">
                        ♥
                    </button>
                </div>
            </div>
        </form>
    </div>
    @endforeach
</div>
@endsection

@section('js')
<script src="{{ asset('js/shop.js') }}" defer></script>
<script src="{{asset('js/search.js') }}" defer></script>
@endsection