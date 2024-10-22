<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\AdminUser;
use App\Models\Role;
use App\Http\Requests\AdminRequest;


class AdminRegisterController extends Controller
{
    public function registerOpen()
    {
        $roles = Role::all();

        return view('admin/admin-register', compact('roles'));
    }

    public function register(AdminRequest $request)
    {
        $adminUser = AdminUser::create([
            'admin_name' => $request->admin_name,
            'admin_email' => $request->admin_email,
            'admin_password' => Hash::make($request->admin_password),
            'role_id' => $request->role_id,
        ]);

        event(new Registered($adminUser)); // メール認証のトリガー

        return redirect()->route('admin.login');
    }

    public function loginOpen() {
        return view('admin/admin-login');
    }
}
