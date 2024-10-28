@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection

@section('content')
<div class="container">
    <h3 class="login-user">{{ $user->name }}さん　お疲れ様です！</h3>
    <div class="search">
        <div class="search-area">
            <form action="{{ route('admin.search') }}" method="get">
                <input class="search__input" type="text" name="search" placeholder="店舗名または店舗代表者で検索" value="{{ $search ?? ''}}">
                <button class="search__button" type="submit">検索</button>
            </form>
        </div>
        <a href="{{ route('admin.owner-create') }}" class="create-shop">店舗管理者登録</a>
    </div>
    <div class="owner">
        <form action="{{ route('admin.shop-detail') }}" method="post">
            @csrf
            <table class="owner__table">
                <tr class="table-row">
                    <th class="table-header">店舗名</th>
                    <th class="table-header">店舗代表者</th>
                </tr>
                @forelse($shops as $shop)
                <tr class="table-row">
                    <td class="table-data">{{ $shop->shop_name }}</td>
                    <td class="table-data">{{ $shop->user->name ?? '代表者なし' }}</td>
                    <td class="table-data">
                        <button class="detail-btn" type="submit">詳細</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">検索結果が見つかりませんでした。</td>
                </tr>
                @endforelse
            </table>
        </form>
        <div class="pagination">
            {{ $shops->links('vendor.pagination.default') }}
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection