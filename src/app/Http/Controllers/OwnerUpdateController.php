<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerUpdateController extends Controller
{
    public function openUpdate(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 1) {
            return redirect('/');
        }

        $request = User::find($request->id);

        return view('admin.owner-update', compact('request'));
    }

    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();

        if ($user->role !== 1) {
            return redirect('/');
        }

        $user = User::findOrFail($request->id);

        $updateData = $request->only(['name', 'email', 'password']);

        if (! empty($updateData['name'])) {
            $user->name = $updateData['name'];
        }

        if (! empty($updateData['email'])) {
            $user->email = $updateData['email'];
        }

        if (! empty($updateData['password'])) {
            $user->password = bcrypt($updateData['password']);
        }

        $user->save();

        return redirect('/admin/dashboard')->with('status', '更新が完了しました');
    }
}
