<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Reservation;
use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role !== 3) {
            return redirect('/');
        }

        $favoriteShopIds = $user ? Favorite::where('user_id', $user->id)->pluck('shop_id')->toArray() : [];

        $favoriteShops = Shop::whereIn('id', $favoriteShopIds)->with('area', 'genre')->get();

        $reservations = $user ? Reservation::where([
            ['user_id', $user->id],
            ['date', '>=', Carbon::today()],
        ])->with('shop')
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get() : [];

        foreach ($reservations as $reservation) {
            if (!$reservation->qr_code_path) {
                $qrCode = QrCode::create(route('reservation.checkin', ['id' => $reservation->id]));
                $writer = new PngWriter();
                $result = $writer->write($qrCode);

                $filePath = 'qrcodes/' . $reservation->id . '.png';
                Storage::disk('public')->put($filePath, $result->getString());

                $reservation->qr_code_path = $filePath;
                $reservation->save();
            }
        }

        return view('mypage', compact('user', 'favoriteShops', 'favoriteShopIds', 'reservations'));
    }

    public function showQrCode($id)
    {
        $user = Auth::user();
        if ($user->role !== 3) {
            return redirect('/');
        }

        $reservation = Reservation::find($id);

        if ($reservation->visited) {
            return redirect()->route('mypage')->with('flash_message', 'すでにチェックイン済みです。');
        }

        return response()->file(storage_path('app/public/' . $reservation->qr_code_path));
    }


    public function checkin($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            abort(404, 'Reservation not found');
        }

        if ($reservation->visited) {
            return redirect()->route('mypage')->with('alert', 'すでにチェックイン済みです。');
        }

        $reservation->visited = true;
        $reservation->save();

        return redirect()->route('mypage')->with('alert', '来店確認が完了しました！');
    }
}
