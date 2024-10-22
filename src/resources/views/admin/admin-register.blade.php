@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin-register.css') }}">
@endsection

@section('content')
<div class="register">
    <div class="register-form">
        <h2 class="register-txt">Admin Registration</h2>
        <form class="register__form-area" action="/admin/register" method="post">
            @csrf
            <div class="container">
                <div class="input-container">
                    <img class="img" src="{{ asset('img/user.svg') }}" alt="user">
                    <input class="user_input" type="text" name="admin_name" placeholder="Admin Username" value="{{ old('admin_name') }}">
                </div>
                <div class="error">
                    @error('admin_name')
                    <P>{{ $message }}</P>
                    @enderror
                </div>
            </div>
            <div class="container">
                <div class="input-container">
                    <img class="img" src="{{ asset('img/mail.svg') }}" alt="mail">
                    <input class="mail_input" type="email" name="admin_email" placeholder="Admin Email" value="{{ old('admin_email') }}">
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
                    <input class="password_input" type="password" name="admin_password" placeholder="Admin Password" value="{{ old('admin_password') }}">
                </div>
                <div class="error">
                    @error('admin_password')
                    <P>{{ $message }}</P>
                    @enderror
                </div>
            </div>
            <div class="container">
                <div class="input-container">
                    <img class="img" src="{{ asset('img/role.svg') }}" alt="role">
                    <select class="role-select" id="role" name="role_id" value="{{ old('role_id') }}">
                        @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="error">
                    @error('role')
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