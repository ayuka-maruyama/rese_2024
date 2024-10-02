@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/reserve-confirm.css') }}">
@endsection

@section('content')
<div class="reserve-confirm">
    <div class="message">
        <h2 class="message-txt">
            ご予約の変更をしました</br>
            ありがとうございます
        </h2>
        <form class="message-btn" action="/" method="get">
            @csrf
            <button class="btn" type="submit">
                <div class="btn-txt">戻る</div>
            </button>
        </form>
    </div>
</div>
@endsection