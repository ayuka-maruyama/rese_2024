<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;



class AdminDashboardController extends Controller
{
    public function openAdminDashboard()
    {
        $user = Auth::user();
        $shops = Shop::with('area', 'genre', 'user')->paginate(10);

        return view('admin/admin-dashboard', compact('user', 'shops'));
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');
        $shops = Shop::with('user')
            ->when($search, function ($query, $search) {
                $query->where('shop_name', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            })
            ->paginate(10);

        return view('admin.admin-dashboard', compact('user', 'shops', 'search'));
    }
}
