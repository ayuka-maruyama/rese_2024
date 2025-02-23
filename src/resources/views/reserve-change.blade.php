@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reserve.css') }}">
<link rel="stylesheet" href="{{ asset('css/reserve-change.css') }}">
@endsection

@section('content')
<div class="reserve-content">
    <div class="shop-detail">
        <form class="shop-detail__form" action="/mypage" method="get">
            <div class="shop-detail__txt">
                <div class="detail-left">
                    <button class="back-btn" type="submit">&lt;</button>
                    <h1 class="shop-name">{{ $reserveNow->shop->shop_name }}</h1>
                </div>
            </div>

            <img src="{{ $reserveNow->shop->image }}" alt="{{ $reserveNow->shop->shop_name }}" class="shop_img">

            <div class="shop-detail__hash">
                <p class="hash-area">#{{ $reserveNow->shop->area->area_name }}</p>
                <p class="hash-genre">#{{ $reserveNow->shop->genre->genre_name }}</p>
            </div>

            <p class="summary">{{ $reserveNow->shop->summary }}</p>
        </form>
    </div>

    <div class="reserve-area">
        <div class="reserved">
            <h3 class="reserved__ttl">現在の予約情報</h3>
            <table class="reserved__table">
                <tr class="table-row">
                    <th class="table-header">予約店</th>
                    <td class="table-data">{{ $reserveNow->shop->shop_name }}</td>
                </tr>
                <tr class="table-row">
                    <th class="table-header">予約日</th>
                    <td class="table-data">{{ $reserveNow->date }}</td>
                </tr>
                <tr class="table-row">
                    <th class="table-header">予約時刻</th>
                    <td class="table-data">{{ date('H:i', strtotime($reserveNow->time)) }}</td>
                </tr>
                <tr class="table-row">
                    <th class="table-header">予約人数</th>
                    <td class="table-data">{{ $reserveNow->number_gest }}</td>
                </tr>
            </table>
        </div>
        
        <div class="reserve-change">
            <form action="{{ route('reservation.update', $reserveNow->id) }}" method="POST">
                @csrf
                @method('PUT')
                <h3 class="reserve-change__ttl">変更内容</h3>
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
                <div class="reserve__btn">
                    <button class="btn" type="submit">変更する</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/reserve.js') }}"></script>
@endsection