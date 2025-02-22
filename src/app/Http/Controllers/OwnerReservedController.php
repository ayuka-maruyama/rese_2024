<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerReservedController extends Controller
{
    public function openReserved(Request $request, $shop_id)
    {
        $user = Auth::user();

        if ($user->role !== 2) {
            return redirect('/');
        }

        $shop = Shop::find($shop_id);
        $date = $request->input('date', Carbon::today()->format('Y-m-d'));

        $dateCarbon = Carbon::createFromFormat('Y-m-d', $date);
        $beforeDate = $dateCarbon->copy()->subDay()->format('Y-m-d');
        $nextDate = $dateCarbon->copy()->addDay()->format('Y-m-d');

        $reservations = Reservation::where('date', $date)
            ->where('shop_id', $shop_id)
            ->with('user')
            ->paginate(5);

        return view('owner.shop-reserved', compact('shop', 'date', 'beforeDate', 'nextDate', 'reservations'));
    }
}
