@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reserve.css') }}">
@endsection

@section('content')
<div class="reserve-content">

    <div class="shop-detail">
        <form class="shop-detail__form" action="/" method="get">
            @csrf
            <div class="shop-detail__txt">
                <div class="detail-left">
                    <button class="back-btn" type="submit">&lt;</button>
                    <h1 class="shop-name">{{ $shop->shop_name }}</h1>
                </div>
            </div>

            <img src="{{ asset($shop->image) }}" alt="{{ $shop->shop_name }}">

            <div class="shop-detail__hash">
                <p class="hash-area">#{{ $shop->area->area_name }}</p>
                <p class="hash-genre">#{{ $shop->genre->genre_name }}</p>
            </div>

            <p class="summary">{{ $shop->summary }}</p>
        </form>

        <div class="evaluation">
            @if($roleCheck)
            <a href="{{ url('/evaluation?shop_id=' . $shop->id) }}" class="evaluation-link">
                口コミを投稿する
            </a>
            @endif
        </div>

    </div>

    <div class="reserve-card">
        <form class="reserve-card__form" action="{{ route('payment.show') }}" method="post">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">

            <div class="reserve-area">
                <h3 class="reserve__txt">予約</h3>

                <div class="custom-date" id="date-picker">
                    <input type="date" id="date" class="date" name="date" value="{{ date('Y-m-d') }}" readonly>
                    <img src="{{ asset('img/calendar-regular.svg') }}" class="calendar-icon"></img>
                </div>

                <div class="select" id="time-picker">
                    <select name="time" id="time">
                    </select>
                    <img src="{{ asset('img/caret-down-solid.svg') }}" class="toggle"></img>
                </div>

                <div class="select" id="gest-picker">
                    <select name="number_gest" id="number_gest">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <img src="{{ asset('img/caret-down-solid.svg') }}" class="toggle"></img>
                </div>

                <div class="reserve-detail"></div>
            </div>

            <div class="reserve__btn">
                <button class="btn" type="submit">予約する</button>
            </div>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </form>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/reserve.js') }}"></script>
@endsection