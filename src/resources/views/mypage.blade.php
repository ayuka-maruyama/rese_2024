@extends('layouts.app')

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('css/shop.css') }}">
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
@endsection

@section('content')
<div class="mypage">
    <div class="login-user">
        <h2 class="user-name">{{ $user->name }} さん</h2>
    </div>
    <div class="mypage-content">
        <div class="reserve">
            <h3 class="reserve-ttl">予約状況</h3>
            @foreach($reservations as $reservation)
            <div class="reserve-card">
                <form action="/reserve-delete" method="post">
                    @csrf
                    <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                    <div class="card-header">
                        <img class="clock" src="{{ asset('img/clock.svg') }}" alt="clock">
                        <div class="justify">
                            <span class="reserve-number">予約{{ $loop->iteration }}</span>
                            @if (!$reservation->visited)
                            <a href="{{ route('reservation.qr', ['id' => $reservation->id]) }}" class="qr-code">
                                <img class="qr-code__img" src="{{ asset('img/qrcode.svg') }}" alt="qr-code">
                            </a>
                            @else
                            <span class="visited-message">
                                <img class="qr-code__img-visited" src="{{ asset('img/qrcode.svg') }}" alt="qr-code">
                            </span>
                            @endif <button name="editing" class="editing" type="submit" formaction="/reserve/change">
                                <img class="editing__img" src="{{ asset('img/editing.svg') }}" alt="editing">
                            </button>
                            <button name="delete" class="delete" type="submit">
                                <img class="close" src="{{ asset('img/close.svg') }}" alt="close">
                            </button>
                        </div>
                    </div>
                    <div class="reserve-details">
                        <table class="reserve-table">
                            <tr>
                                <th class="table-header">Shop</th>
                                <td class="table-date">{{ $reservation->shop->shop_name }}</td>
                            </tr>
                            <tr>
                                <th class="table-header">Date</th>
                                <td class="table-date">{{ $reservation->date }}</td>
                            </tr>
                            <tr>
                                <th class="table-header">Time</th>
                                <td class="table-date">{{ $reservation->time }}</td>
                            </tr>
                            <tr>
                                <th class="table-header">Number</th>
                                <td class="table-date">{{ $reservation->number_gest }}</td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
            @endforeach
        </div>
        <div class="favorite">
            <h3 class="favorite-ttl">お気に入り店舗</h3>
            <div class="shop-card__wrap">
                @foreach($favoriteShops as $shop)
                <div class="shop-card">
                    <form class="shop-card__form" action="/detail/{{ $shop->id }}" method="get">
                        @csrf
                        <div class="shop-card__img">
                            <img class="shop-card__img" src="{{ $shop->image }}" alt="{{ $shop->shop_name }}">
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
        </div>
    </div>
</div>

@if(session('alert'))
<script>
    window.onload = function() {
        alert("{{ session('alert') }}");
    };
</script>
@endif

@endsection

@section('js')
<script src="{{ asset('js/mypage.js') }}" defer></script>
<script src="{{ asset('js/closeQr.js') }}" defer></script>
@endsection