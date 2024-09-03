@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login">
    <div class="login-form">
        <h2 class="login-txt">Login</h2>
        <form class="login__form-area" action="/login" method="post">
            @csrf
            <div class="container">
                <div class="input-container">
                    <img class="img" src="{{ asset('img/mail.jpg') }}" alt="mail">
                    <input class="mail_input" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                </div>
                <div class="error">
                    @error('email')
                    <P>{{ $message }}</P>
                    @enderror
                </div>
            </div>
            <div class="container">
                <div class="input-container">
                    <img class="img" src="{{ asset('img/key.jpg') }}" alt="password">
                    <input class="password_input" type="password" name="password" placeholder="Password" value="{{ old('password') }}">
                </div>
                <div class="error">
                    @error('password')
                    <P>{{ $message }}</P>
                    @enderror
                </div>
            </div>
            <button class="login__form-btn" type="submit">
                <div class="login__form-btn-txt">ログイン</div>
            </button>
        </form>
    </div>
</div>
@endsection