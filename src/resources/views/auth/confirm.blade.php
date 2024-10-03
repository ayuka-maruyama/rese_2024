@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm">
    <div class="confirm-form">
        <h2 class="confirm-txt">
            会員登録ありがとうございます
        </h2>
        <p class="confirm-msg">
            会員登録を受け付けました。</br>
            現在は仮登録の状態です。</br>
            ご入力いただいたメールアドレス宛に、確認のメールをお送りしています。</br>
            メールに記載のURLをクリックし会員登録を完了させてください。</br>
            もし、メールが届いていない場合は、迷惑メールフォルダをご確認ください。</br>
        </p>
        <form class="confirm__form-btn" method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="confirm__form-btn-txt">
                <span class=span>{{ __('メールの再送信はこちら')}}</span>
            </button>
        </form>
    </div>
</div>
@endsection