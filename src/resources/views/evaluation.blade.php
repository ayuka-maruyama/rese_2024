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
        <form id="evaluation-form" action="{{ route('evaluation.confirm') }}" method="post">
            @csrf
            <input type="hidden" name="shop_id" value="{{ $shop->id }}">

            <div class="evaluation">
                <h3 class="select-ttl">体験を評価してください</h3>
                <div class="rating">
                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>
                    <input type="hidden" id="rating-value" name="evaluation" value="">
                </div>
            </div>

            <div class="comment">
                <h3 class="input-ttl">口コミを投稿</h3>
                <textarea class="evaluation-textarea" name="comment" id="commentInput" cols="50" rows="8" placeholder="カジュアルな夜のお出かけにおすすめのスポット">{{ old('comment') }}</textarea>
            </div>

            <div class="add_image">
                <h3 class="input-ttl">画像の追加</h3>
                <div class="image-upload">
                    <label for="image" class="file-upload">
                        クリックして写真を追加<br>
                        またはドラッグアンドドロップ
                    </label>
                    <input type="file" name="image" id="image" style="display: none;">
                    <p id="file-name" class="file-name"></p>
                    <div id="preview-area" class="preview-area">
                        <img id="image-preview" class="image-preview" src="" alt="プレビュー画像" style="display: none; max-width: 100%; height: auto;">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="button-area">
    <button class="evaluation-submit" type="submit">口コミを投稿</button>
</div>

@endsection

@section('js')
<script src="{{ asset('js/evaluation.js') }}" defer></script>
<script src="{{ asset('js/form-interactions.js') }}" defer></script>
@endsection