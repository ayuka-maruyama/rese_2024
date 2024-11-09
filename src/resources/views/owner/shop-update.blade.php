@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop-update.css') }}">
@endsection

@section('content')
<div class="update">
    <h3 class="shop-update">店舗情報の更新</h3>
    <p class="message">変更がある箇所のみ入力してください。</p>
    <div class="input-area">
        <form action="{{ route('owner.shop.update', ['id' => $shop->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input class="hidden" type="hidden" name="user_id" value="{{ $user->id }}">

            <div class="input-area">
                <div class="ttl">
                    <label for="shop_name" class="label-name">
                        店舗名
                    </label>
                </div>
                <input class="input-txt" type="text" name="shop_name" id="shop_name" value="{{ $shop->shop_name }}">
                <div class="error">
                    @error('shop_name')
                    <P>{{ $message }}</P>
                    @enderror
                </div>
            </div>

            <div class="flex">
                <div class="input-area flex-area">
                    <div class="ttl">
                        <label for="area_id" class="label-name">
                            エリア
                        </label>
                    </div>
                    <select class="pulldown" name="area_id" id="area_id">
                        @foreach($areas as $area)
                        <option class="list" value="{{ $area->id }}" {{ $shop->area_id == $area->id ? 'selected' : '' }}>{{ $area->area_name }}</option>
                        @endforeach
                    </select>
                    <div class="error">
                        @error('area_id')
                        <P>{{ $message }}</P>
                        @enderror
                    </div>
                </div>

                <div class="input-area flex-area">
                    <div class="ttl">
                        <label for="genre" class="label-name">
                            ジャンル
                        </label>
                    </div>
                    <select class="pulldown" name="genre_id" id="genre_id">
                        @foreach($genres as $genre)
                        <option class="list" value="{{ $genre->id }}" {{ $shop->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->genre_name }}</option>
                        @endforeach
                    </select>
                    <div class="error">
                        @error('genre_id')
                        <P>{{ $message }}</P>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="input-area">
                <div class="ttl">
                    <label for="summary" class="label-name">
                        店舗概要
                    </label>
                </div>
                <textarea class="textarea" name="summary" id="summary">{{ $shop->summary }}</textarea>
            </div>
            <div class="error">
                @error('summary')
                <P>{{ $message }}</P>
                @enderror
            </div>

            <div class="input-area">
                <div class="ttl">
                    <label for="image" class="label-name">
                        店舗画像
                    </label>
                </div>
                <div id="preview-area">
                    <img id="image-preview" src="{{ $shop->image }}" alt="{{ $shop->shop_name }}" class="{{ $shop->image ? 'image-visible' : '' }}">
                </div>
                <div class="img-area">
                    <span id="file-name">ファイルが選択されていません</span>
                    <label for="image" class="file-upload">
                        画像を選択
                    </label>
                    <input type="file" name="image" id="image" style="display: none;">
                </div>
            </div>
            <div class="error">
                @error('image')
                <P>{{ $message }}</P>
                @enderror
            </div>

            <div class="btn-area">
                <button class="back-btn" type="submit" formaction="/owner/dashboard" formmethod="get">戻る</button>
                <button class="update-btn" type="submit">店舗情報更新</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script>
    const textarea = document.querySelector("textarea");
    textarea.addEventListener("input", function() {
        this.style.height = "auto";
        this.style.height = (this.scrollHeight) + "px";
    });

    document.getElementById("image").addEventListener("change", function() {
        const fileName = this.files[0] ? this.files[0].name : "ファイルが選択されていません";
        document.getElementById("file-name").textContent = fileName;
    });

    document.getElementById("image").addEventListener("change", function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                const preview = document.getElementById("image-preview");
                preview.src = e.target.result;
                preview.style.display = "block";
            };

            reader.readAsDataURL(file);
        }
    });
</script>
@endsection