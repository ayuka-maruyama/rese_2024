@extends('layouts.app')

@section('css')
@endsection

@section('content')
<form action="{{ route('admin.owner-update', ['id' => $request->id]) }}" method="post">
    @csrf
    <table>
        <tr class="table-row">
            <th class="table-header">店舗管理者名</th>
            <td class="table-date">
                <input type="text" name="name" value="{{ $request->name }}">
            </td>
        </tr>
        <tr class="table-row">
            <th class="table-header">登録済みメールアドレス</th>
            <td class="table-date">
                <input type="text" name="email" value="{{ $request->email }}">
            </td>
        </tr>
        <tr class="table-row">
            <th class="table-header">パスワード</th>
            <td class="table-date">
                @if($request->password)
                <span><input type="text" name="password" value=""></span>
                @endif
            </td>
        </tr>
        <tr class="table-row">
            <th class="table-header"></th>
            <td class="table-date">
                <button class="update-btn" type="submit">更新</button>
            </td>
        </tr>
    </table>
</form>

@error('name')
<P>{{ $message }}</P>
@enderror
@error('email')
<P>{{ $message }}</P>
@enderror
@error('password')
<P>{{ $message }}</P>
@enderror

@endsection