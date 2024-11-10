@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/shop-register.css') }}">
@endsection

@section('content')
<div class="register-area">
    <h3 class="title">店舗新規登録</h3>
    <form action="{{ route('owner.shop-create') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input class="hidden" type="hidden" name="user_id" value="{{ $user->id }}">

        <div class="input-area">
            <div class="ttl">
                <label for="shop_name" class="label-name">
                    店舗名<span class="required">必須</span>
                </label>
            </div>
            <input class="input-txt" type="text" name="shop_name" id="shop_name" placeholder="店舗名を入力してください。" value="{{ old('shop_name') }}">
            <div class=" error">
            @error('shop_name')
            <P>{{ $message }}</P>
            @enderror
        </div>
</div>

<div class="flex">
    <div class="input-area flex-area">
        <div class="ttl">
            <label for="area_id" class="label-name">
                エリア<span class="required">必須</span>
            </label>
        </div>
        <select class="pulldown" name="area_id" id="area_id">
            @foreach($areas as $area)
            <option class="list" value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }}>{{ $area->area_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="error">
        @error('area_id')
        <P>{{ $message }}</P>
        @enderror
    </div>

    <div class="input-area flex-area">
        <div class="ttl">
            <label for="genre" class="label-name">
                ジャンル<span class="required">必須</span>
            </label>
        </div>
        <select class="pulldown" name="genre_id" id="genre_id">
            @foreach($genres as $genre)
            <option class="list" value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>{{ $genre->genre_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="error">
        @error('genre_id')
        <P>{{ $message }}</P>
        @enderror
    </div>
</div>

<div class="input-area">
    <div class="ttl">
        <label for="summary" class="label-name">
            店舗概要<span class="required">必須</span>
        </label>
    </div>
    <textarea class="textarea" name="summary" id="summary" placeholder="店舗概要を入力してください。">{{ old('summary') }}</textarea>
</div>
<div class="error">
    @error('summary')
    <P>{{ $message }}</P>
    @enderror
</div>

<div class="input-area">
    <div class="ttl">
        <label for="image" class="label-name">
            店舗画像<span class="required">必須</span>
        </label>
    </div>
    <label for="image" class="file-upload">
        画像を選択
    </label>
    <input type="file" name="image" id="image" style="display: none;">
    <div id="preview-area">
        <img id="image-preview" src="" alt="プレビュー画像" style="display: none; max-width: 100%; height: auto;">
    </div>
    <span id="file-name">ファイルが選択されていません</span>
</div>
<div class="error">
    @error('image')
    <P>{{ $message }}</P>
    @enderror
</div>

<div class="btn-area">
    <button class="back-btn" type="submit" formaction="/owner/dashboard" formmethod="get">戻る</button>
    <button class="create-btn" type="submit">店舗新規登録</button>
</div>
</form>
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