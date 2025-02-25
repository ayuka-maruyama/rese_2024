@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="{{ asset('css/shop-import.css') }}">
@endsection

@section('content')
<!-- エラーなどのメッセージ表示部分 -->
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

<div class="container">
    <h1 class="container-ttl">店舗データのインポート</h1>

    <div class="download-csv">
        <h3 class="download-ttl">CSVファイルのダウンロード</h3>
        <a href="{{ route('shop.import.download-template') }}" class="btn btn-download">ダウンロード</a>
    </div>

    <div class="upload">
        <h3 class="upload-ttl">CSVファイルのアップロード</h3>
        <form action="{{ route('shop.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="zip_file" class="zip-label">CSVファイルを選択</label>
                <input type="file" name="csv_file" accept=".csv" class="form-control"> @error('zip_file')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">アップロード</button>
        </form>
    </div>
</div>
@endsection