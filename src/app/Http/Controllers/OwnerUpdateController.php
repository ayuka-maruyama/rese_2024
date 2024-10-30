<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;

class OwnerUpdateController extends Controller
{
    public function openUpdate(Request $request)
    {
        $request = User::find($request->id);

        return view('admin.owner-update', compact('request'));
    }

    public function update(UpdateUserRequest $request)
    {
        // IDからユーザー情報を取得
        $user = User::findOrFail($request->id);

        // 更新したいデータをフィルタリング（リクエストから）
        $updateData = $request->only(['name', 'email', 'password']);

        // 名前とメールアドレスが変更されている場合のみ、更新データを設定
        if (!empty($updateData['name'])) {
            $user->name = $updateData['name'];
        }

        if (!empty($updateData['email'])) {
            $user->email = $updateData['email'];
        }

        // パスワードが入力されている場合のみハッシュ化して更新
        if (!empty($updateData['password'])) {
            $user->password = bcrypt($updateData['password']);
        }

        // 更新を保存
        $user->save();

        // リダイレクト
        return redirect('/admin/dashboard')->with('status', '更新が完了しました');
    }
}
