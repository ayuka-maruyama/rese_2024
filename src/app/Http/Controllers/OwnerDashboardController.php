<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    public function openOwnerDashboard()
    {
        $user = Auth::user();
        $shops = Shop::where('user_id', $user->id)->with('area', 'genre')->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('owner/owner-dashboard', compact('user', 'shops', 'areas', 'genres'));
    }
}
