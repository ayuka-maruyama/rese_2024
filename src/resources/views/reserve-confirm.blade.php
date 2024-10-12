@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reserve-confirm.css') }}">
@endsection

@section('content')
<div class="reserve-confirm">
    <div class="message">
        <h2 class="message-txt">ご予約ありがとうございます</h2>
        <p class="message-txt-p">
            事前決済が完了しました</br>
            ご予約日当日のご来店を心よりお待ちしております
        </p>
        <form class="message-btn" action="/" method="get">
            @csrf
            <button class="btn" type="submit">
                <div class="btn-txt">戻る</div>
            </button>
        </form>
    </div>
</div>
@endsection