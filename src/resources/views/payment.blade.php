@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
<div class="reserve-info">
    <h3 class="info-ttl">ご予約情報</h3>
    <form id="payment-form" action="{{ route('stripe.charge') }}" method="POST">
        @csrf
        <input type="hidden" name="shop_id" value="{{ $request->shop_id }}">
        <input type="hidden" name="date" value="{{ $request->date }}">
        <input type="hidden" name="time" value="{{ $request->time }}">
        <input type="hidden" name="number_gest" value="{{ $request->number_gest }}">

        <table class="info-table">
            <tr class="table-row">
                <th class="table-header">予約者</th>
                <td class="table-data">{{ $user->name }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-header">メールアドレス</th>
                <td class="table-data">{{ $user->email }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-header">予約店舗</th>
                <td class="table-data">{{ $shop->shop_name }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-header">予約日</th>
                <td class="table-data">{{ $request->date }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-header">予約時刻</th>
                <td class="table-data">{{ $request->time }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-header">予約人数</th>
                <td class="table-data">{{ $request->number_gest }}</td>
            </tr>
            <tr class="table-row">
                <th class="table-header">決済金額</th>
                <td class="table-data">{{ number_format($totalAmount) }}円</td>
            </tr>
        </table>

        <div class="form-group">
            <label for="card-number">カード番号</label>
            <div id="card-number"></div>
            <img id="card-brand-logo" src="" alt="カードブランド" style="display:none; width:50px;">
        </div>

        <div class="form-group">
            <label for="card-expiry">有効期限</label>
            <div id="card-expiry"></div>
        </div>

        <div class="form-group">
            <label for="card-cvc">セキュリティコード</label>
            <div id="card-cvc"></div>
        </div>

        <div id="card-errors" role="alert"></div>
        <button class="pay-btn" type="submit">支払いを行う</button>
    </form>

</div>
@endsection

@section('js')
<script src="https://js.stripe.com/v3/"></script>
<script>
    // BladeテンプレートからAPIキーをJavaScriptに渡す
    const stripePublicKey = "{{ config('services.stripe.key') }}";
</script>
<script src="{{ asset('js/stripe.js') }}" defer></script>
@endsection