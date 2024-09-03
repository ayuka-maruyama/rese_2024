@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
<div class="register">
    <div class="register-form">
        <h2 class="register-txt">Registration</h2>
        <form class="register__form-area" action="/register" method="post">
            @csrf
            <div class="container">
                <div class="input-container">
                    <img class="img" src="{{ asset('img/user.jpg') }}" alt="user">
                    <input class="user_input" type="text" name="name" placeholder="Username" value="{{ old('name') }}">
                </div>
                <div class="error">
                    @error('name')
                    <P>{{ $message }}</P>
                    @enderror
                </div>
            </div>
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
            <button class="register__form-btn" type="submit">
                <div class="register__form-btn-txt">登録</div>
            </button>
        </form>
    </div>
</div>
@endsection