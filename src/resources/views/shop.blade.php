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
                    <button>
                        <svg class="favorite-btn {{ in_array($shop->id, $favoriteShopIds) ? 'favorited' : '' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-id="{{ $shop->id }}">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
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