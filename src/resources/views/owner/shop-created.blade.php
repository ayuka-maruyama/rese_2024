@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm">
    <div class="confirm-form">
        <h2 class="confirm-txt">
            新規店舗を登録しました！
        </h2>
        <p class="confirm-msg">
            入力いただいた内容で、新規店舗を登録しました。<br>
            トップ画面より確認いただけますので、ご確認をお願いいたします。
        </p>
        <form class="confirm__form-btn" method="get" action="{{ route('owner.dashboard') }}">
            @csrf
            <button type="submit" class="confirm__form-btn-txt">
                <span class=span>戻る</span>
            </button>
        </form>
    </div>
</div>
@endsection