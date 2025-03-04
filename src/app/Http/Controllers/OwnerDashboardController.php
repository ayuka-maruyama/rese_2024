<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Genre;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    public function openOwnerDashboard()
    {
        $user = Auth::user();

        if ($user->role !== 2) {
            return redirect('/');
        }

        $shops = Shop::where('user_id', $user->id)->with('area', 'genre')->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('owner/owner-dashboard', compact('user', 'shops', 'areas', 'genres'));
    }
}
