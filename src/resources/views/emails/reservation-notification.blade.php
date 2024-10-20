@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reservation-notification.css') }}">
@endsection

@section('content')
<div class="mail">
    <h3 class="title">本日のご予約情報のお知らせ</h3>
    <p class="table-title">ご予約情報</p>
    <div class="table-content">
        <table class="table-area">
            <tr class="table-row">
                <th class="table-header">ご予約者:</th>
                <td class="table-data">{{ $user->name }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-header">予約日時:</th>
                <td class="table-data">{{ $reservation->date }} {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-header">予約人数:</th>
                <td class="table-data">{{ $reservation->number_gest }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-header">予約店舗:</th>
                <td class="table-data">{{ $reservation->shop->shop_name }}</td>
            </tr>
        </table>
    </div>
    <p class="message">本日のご来店、従業員一同心よりお待ちしております。</p>
</div>
@endsection