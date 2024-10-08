@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/evaluation.css') }}">
@endsection

@section('content')
<div class="evaluation">
    <div class="evaluation-card">
        <h3 class="evaluation__ttl">お店レビュー</h3>
        <img class="shop_img" src="{{ $shop->image }}" alt="{{ $shop->shop_name }}">
        <div class="evaluation__table">
            <form action="/evaluation-confirm" method="post">
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
                                <input type="hidden" class="rating" id="rating-value">
                                <span class="star" data-value="1">★</span>
                                <span class="star" data-value="2">★</span>
                                <span class="star" data-value="3">★</span>
                                <span class="star" data-value="4">★</span>
                                <span class="star" data-value="5">★</span>
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
                            <textarea class="evaluation-txtarea" name="comment" id="comment" cols="50" rows="10"></textarea>
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
<script src="{{ asset('js/evaluation.js') }}"></script>
@endsection