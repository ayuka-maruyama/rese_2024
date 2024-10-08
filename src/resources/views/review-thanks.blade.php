@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm">
    <div class="confirm-form">
        <h2 class="confirm-txt">
            レビューありがとうございます
        </h2>
        <p class="confirm-msg">
            今後の参考にさせていただきます
        </p>
        <form class="confirm__form-btn" method="get" action="/">
            @csrf
            <button type="submit" class="confirm__form-btn-txt">
                <span class=span>店舗一覧画面へ</span>
            </button>
        </form>
    </div>
</div>
@endsection