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
        $user = User::findOrFail($request->id);

        $updateData = $request->only(['name', 'email', 'password']);

        if (!empty($updateData['name'])) {
            $user->name = $updateData['name'];
        }

        if (!empty($updateData['email'])) {
            $user->email = $updateData['email'];
        }

        if (!empty($updateData['password'])) {
            $user->password = bcrypt($updateData['password']);
        }

        $user->save();

        return redirect('/admin/dashboard')->with('status', '更新が完了しました');
    }
}
