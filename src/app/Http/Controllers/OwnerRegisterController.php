<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class OwnerRegisterController extends Controller
{
    public function openOwnerCreate()
    {
        return view('admin/admin-register');
    }

    public function ownerRegister(RegisterRequest $request)
    {
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
