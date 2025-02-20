@extends('layouts.app')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection

@section('header')
<div class="search">
    <form class="search-form" id="search-form" action="{{ route('shop.search') }}" method="post">
        @csrf
        <label for="sort" class="search-form__label">並び替え：</label>
        <select class="search-form__item-select" name="sort" id="sort">
            <option class="sort-option" value="random" selected>ランダム</option>
            <option class="sort-option" value="highly-rated">評価が高い順</option>
            <option class="sort-option" value="low-rated">評価が低い順</option>
        </select>
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
<div class="sort-info">検索情報：</div>
<div class="shop-card__wrap">
    @foreach($shops as $shop)
    @include('partials.shop-card', ['shop' => $shop, 'favoriteShopIds' => $favoriteShopIds])
    @endforeach
</div>
@endsection

@section('js')
<script src="{{ asset('js/shop.js') }}" defer></script>
<script src="{{ asset('js/search.js') }}" defer></script>
@endsection