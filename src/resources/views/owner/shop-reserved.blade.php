@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/owner-shop-reserved.css') }}">
@endsection

@section('content')
<div class="reserved">
    <h3 class="shop-name">{{ $shop->shop_name }} 予約情報一覧</h3>
    <div class="date">
        <a href="{{ route('owner.reserved', ['id' => $shop->id, 'date' => $beforeDate]) }}" class="date__title-before">&lt;</a>
        <h3 class="date__title">{{ $date }}</h3>
        <a href="{{ route('owner.reserved', ['id' => $shop->id, 'date' => $nextDate]) }}" class="date__title-after">&gt;</a>
    </div>
    <div class="user-reserved">
        <table class="table-area">
            <tr class="table-row">
                <th class="table-header">予約者</th>
                <th class="table-header">予約時刻</th>
                <th class="table-header">予約人数</th>
            </tr>
            @foreach($reservations as $reservation)
            <tr class="table-row">
                <td class="table-data">{{ $reservation->user->name }}</td>
                <td class="table-date">{{ \Carbon\Carbon::createFromFormat('H:i:s', $reservation->time)->format('H:i')  }}</td>
                <td class="table-date">{{ $reservation->number_gest }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div class="pagination">
        {{ $reservations->links('vendor.pagination.default') }}
    </div>
</div>
@endsection