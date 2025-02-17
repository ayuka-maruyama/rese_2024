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

    <div class="evaluation">
        <div class="evaluation__area">
            <form id="evaluation-form" action="{{ route('evaluation.confirm') }}" method="post">
                @csrf
                <input type="hidden" name="shop_id" value="{{ $shop->id }}">
                <table class="evaluation__table-area">
                    <tr class="table-row__shop">
                        <th class="table-header">店名</th>
                        <td class="table-data">{{ $shop->shop_name }}</td>
                    </tr>
                    <tr class="table-row__require">
                        <th class="table-header">
                            評価</br>
                            <span class="require">必須</span>
                        </th>
                        <td class="table-data">
                            <div class="rating">
                                <span class="star" data-value="1">★</span>
                                <span class="star" data-value="2">★</span>
                                <span class="star" data-value="3">★</span>
                                <span class="star" data-value="4">★</span>
                                <span class="star" data-value="5">★</span>
                                <input type="hidden" id="rating-value" name="evaluation" value="">
                            </div>
                            <p class="txt">星をクリックして入力してください</p>
                        </td>
                    </tr>
                    <tr class="table-row">
                        <th class="table-header">
                            レビュー本文</br>
                            <span class="require">必須</span>
                        </th>
                        <td class="table-data">
                            <textarea class="evaluation-txtarea" name="comment" id="comment" cols="50" rows="8" placeholder="コメントを入力してください">{{ old('comment') }}</textarea>
                        </td>
                    </tr>
                </table>
                <div class="button-area">
                    <button class="evaluation-submit" type="submit">送信</button>
                    <button class="back-button" type="button" onClick="history.back();">戻る</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/evaluation.js') }}" defer></script>
@endsection