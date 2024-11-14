<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class OwnerShopListController extends Controller
{
    public function openShopList(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 1) {
            return redirect('/');
        }

        $user = User::find($request->id);

        $shops = Shop::where('user_id', $user->id)->get();

        return view('admin.shop-list', compact('user', 'shops'));
    }
}
