<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Reservation;
use Carbon\Carbon;

class OwnerReservedController extends Controller
{
    public function openReserved(Request $request, $shop_id)
    {
        $shop = Shop::find($shop_id);
        $date = $request->input('date', Carbon::today()->format("Y-m-d"));

        $dateCarbon = Carbon::createFromFormat('Y-m-d', $date);
        $beforeDate = $dateCarbon->copy()->subDay()->format('Y-m-d');
        $nextDate = $dateCarbon->copy()->addDay()->format('Y-m-d');

        $reservations = Reservation::where('date', $date)
            ->with('user')
            ->paginate(5);

        return view('owner.shop-reserved', compact('shop', 'date', 'beforeDate', 'nextDate', 'reservations'));
    }
}
