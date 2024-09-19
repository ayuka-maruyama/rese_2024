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
                <button class="back-btn" type="submit">&lt;</button>
                <h1 class="shop-name">{{ $shop->shop_name }}</h1>
            </div>
            <img src="{{ $shop->image }}" alt="{{ $shop->shop_name }}">
            <div class="shop-detail__hash">
                <p class="hash-area">#{{ $shop->area->area_name }}</p>
                <p class="hash-genre">#{{ $shop->genre->genre_name }}</p>
            </div>
            <p class="summary">{{ $shop->summary }}</p>
        </form>
    </div>
    <div class="reserve-card">
        <form action="/done" class="reserve-card__form" method="post">
            @csrf
            <div class="reserve-area">
                <h3 class="reserve__txt">予約</h3>
                <div class="custom-date" id="date-picker">
                    <input type="date" id="date" class="date" name="date" readonly>
                    <img src="{{ asset('img/calendar-regular.svg') }}" class="calendar-icon"></img>
                </div>
                <div class="select" id="time-picker">
                    <select name="time" id="time">
                        <option value="18:00">18:00</option>
                        <option value="18:30">18:30</option>
                        <option value="19:00">19:00</option>
                        <option value="19:30">19:30</option>
                        <option value="20:00">20:00</option>
                        <option value="20:30">20:30</option>
                        <option value="21:00">21:00</option>
                    </select>
                    <img src="{{ asset('img/caret-down-solid.svg') }}" class="toggle"></img>
                </div>
                <div class="select" id="gest-picker">
                    <select name="gest" id="gest">
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
        </form>
    </div>
    @endsection

    @section('js')
    <script src="{{ asset('js/reserve.js') }}"></script>
    @endsection