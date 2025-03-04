<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class OwnerRegisterController extends Controller
{
    public function openOwnerCreate()
    {
        $user = Auth::user();

        if ($user->role !== 1) {
            return redirect('/');
        }

        return view('admin/admin-register');
    }

    public function ownerRegister(RegisterRequest $request)
    {
        $user = Auth::user();

        if ($user->role !== 1) {
            return redirect('/');
        }

        $role = $request->input('role', 2);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        event(new Registered($user));

        return redirect('/thanks');
    }
}
