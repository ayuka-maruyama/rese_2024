@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin-login.css') }}">
@endsection

@section('content')
<div class="login">
    <div class="login-form">
        <h2 class="login-txt">Login</h2>
        <form class="login__form-area" action="{{ route('admin.login') }}" method="post">
            @csrf
            <div class="container">
                <div class="input-container">
                    <img class="img" src="{{ asset('img/mail.svg') }}" alt="mail">
                    <input class="mail_input" type="email" name="admin_email" placeholder="Admin Email" value="{{ old('admin-email') }}">
                </div>
                <div class="error">
                    @error('admin_email')
                    <P>{{ $message }}</P>
                    @enderror
                </div>
            </div>
            <div class="container">
                <div class="input-container">
                    <img class="img" src="{{ asset('img/lock.svg') }}" alt="password">
                    <input class="password_input" type="password" name="admin_password" placeholder="Admin Password" value="{{ old('admin-password') }}">
                </div>
                <div class="error">
                    @error('admin_password')
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