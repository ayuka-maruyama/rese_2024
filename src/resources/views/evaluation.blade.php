@extends('layouts.app')

@section('css')
<!-- いろいろなところでCSSを使いまわしているので、共通部分はcommon.cssにまとめる -->
<link rel="stylesheet" href="{{ asset('css/reserve.css') }}">
<link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
<link rel="stylesheet" href="{{ asset('css/evaluation.css') }}">
@endsection

@section('content')
<div class="reserve-content">
    <div class="shop">
        <h2 class="shop-card_ttl">今回のご利用はいかがでしたか？</h2>
        @include('partials.shop-card', ['shop' => $shop, 'favoriteShopIds' => $favoriteShopIds])
    </div>

    <div class="evaluation__area">
        <div class="evaluation">
            <h3 class="select-ttl">体験を評価してください</h3>
            <div class="rating">
                <span class="star" data-value="1">★</span>
                <span class="star" data-value="2">★</span>
                <span class="star" data-value="3">★</span>
                <span class="star" data-value="4">★</span>
                <span class="star" data-value="5">★</span>
            </div>
            <div class="error">
                @error('evaluation')
                <P>{{ $message }}</P>
                @enderror
            </div>
        </div>

        <div class="comment">
            <h3 class="input-ttl">口コミを投稿</h3>
            @if($existingEvaluation)
            <textarea class="evaluation-textarea" name="comment" id="commentInput" cols="50" rows="8" placeholder="カジュアルな夜のお出かけにおすすめのスポット">{{ $existingEvaluation->comment }}</textarea>
            @else
            <textarea class="evaluation-textarea" name="comment" id="commentInput" cols="50" rows="8" placeholder="カジュアルな夜のお出かけにおすすめのスポット">{{ old('comment') }}</textarea>
            @endif
            <div class="error">
                @error('comment')
                <P>{{ $message }}</P>
                @enderror
            </div>
        </div>

        <div class="add_image">
            <h3 class="input-ttl">画像の追加</h3>
            <div class="image-upload">

                <!-- 既存の画像があれば表示 -->
                @if($existingEvaluation && $existingEvaluation->image_url)
                <div id="preview-area" class="preview-area">
                    <img id="image-preview" class="image-preview" src="{{ asset($existingEvaluation->image_url) }}" alt="プレビュー画像" style="max-width: 100%; height: auto;">
                </div>
                @else
                <label for="image" class="file-upload">
                    クリックして写真を追加<br>
                    またはドラッグアンドドロップ
                </label>
                <div id="preview-area" class="preview-area">
                    <img id="image-preview" class="image-preview" src="" alt="プレビュー画像" style="display: none; max-width: 100%; height: auto;">
                </div>
                @endif
            </div>
            <div class="error">
                @error('image_url')
                <p>{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="button-area">
    <form id="evaluation-form"
        action="{{ $existingEvaluation ? route('evaluation.update', ['evaluation' => $existingEvaluation->id]) : route('evaluation.confirm') }}"
        method="POST"
        enctype="multipart/form-data">
        @csrf
        @if ($existingEvaluation)
        @method('PUT')
        @endif
        <input type="hidden" name="shop_id" value="{{ $shop->id }}">
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="hidden" id="rating-value" name="evaluation" value="{{ $existingEvaluation ? $existingEvaluation->evaluation : '' }}">

        <!-- 追加: textarea の値を送るための hidden input -->
        <input type="hidden" id="hidden-comment" name="comment" value="">
        <input type="hidden" name="image_file_name" id="image-file-name" value="">

        <input type="file" name="image_url" id="image" style="display: none;">
        <button class="evaluation-submit" type="submit">口コミを投稿</button>
    </form>
</div>
@endsection

@section('js')
<script src="{{ asset('js/evaluation.js') }}" defer></script>
<script src="{{ asset('js/form-interactions.js') }}" defer></script>
@endsection