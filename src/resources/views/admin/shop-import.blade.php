@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/shop-import.css') }}">
@endsection

@section('content')
<div class="container">
    <h1 class="container-ttl">店舗データのインポート</h1>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
    <div class="alert alert-success">{{ session('error') }}</div>
    @endif
    @if (session('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('shop.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="zip_file" class="zip-label">ZIPファイルを選択</label>
            <input type="file" name="zip_file" class="form-control" required>
            @error('zip_file')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">インポート</button>
    </form>
</div>
@endsection