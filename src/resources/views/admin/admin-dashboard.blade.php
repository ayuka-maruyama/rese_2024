@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endsection

@section('content')
<div class="container">
    @if(session('success'))
    <div class="alert alert-success" id="success-message">
        {{ session('success') }}
    </div>
    @endif
    <h3 class="login-user">{{ $user->name }}さん　お疲れ様です！</h3>
    <div class="search">
        <div class="search-area">
            <form action="{{ route('admin.search') }}" method="get">
                <input class="search__input" type="text" name="search" placeholder="店舗名または店舗代表者で検索" value="{{ $search ?? ''}}">
                <button class="search__button" type="submit">検索</button>
            </form>
        </div>
        <div class="link-area">
            <a href="{{ route('admin.owner-create') }}" class="create-shop">店舗管理者登録</a>
            <a href="{{ route('admin.sendEmail') }}" class="admin-mail">メール</a>
        </div>
    </div>
    <div class="owner">
        <table class="owner__table">
            <tr class="table-row">
                <th class="table-header">店舗代表者</th>
                <th class="table-header"></th>
                <th class="table-header"></th>
            </tr>
            @forelse($users as $user)
            <tr class="table-row">
                <td class="table-data">{{ $user->name ?? '代表者なし' }}</td>
                <form action=" {{ route('admin.owner-update-open', ['id' => $user->id]) }}" method="get">
                    @csrf
                    <td class="table-data">
                        <input type="hidden" value="{{ $user->id }}">
                        <button class="update-btn" type="submit">更新</button>
                    </td>
                </form>
                <form action="{{ route('admin.owner-shoplist', ['id' => $user->id]) }}" method="get">
                    <td class="table-data">
                        <button class="detail-btn" type="submit">店舗詳細</button>
                    </td>
                </form>
            </tr>
            @empty
            <tr>
                <td colspan="3">検索結果が見つかりませんでした。</td>
            </tr>
            @endforelse
        </table>
        <div class="pagination">
            {{ $users->links('vendor.pagination.default') }}
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    // 成功メッセージがある場合
    window.onload = function() {
        var successMessage = document.getElementById('success-message');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 3000);
        }
    };
</script>
@endsection