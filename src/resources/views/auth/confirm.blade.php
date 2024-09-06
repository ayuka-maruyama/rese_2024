@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm">
    <div class="confirm-form">
        <h2 class="confirm-txt">会員登録ありがとうございます</h2>
        <form class="confirm__form-area" action="/login" method="get">
            @csrf
            <button class="confirm__form-btn" type="submit">
                <div class="confirm__form-btn-txt">ログインする</div>
            </button>
        </form>
    </div>
</div>
@endsection