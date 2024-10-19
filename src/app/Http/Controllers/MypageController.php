<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use App\Models\Favorite;
use App\Models\Reservation;
use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage; // ストレージの使用

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // お気に入りの店舗IDリストを配列で取得
        $favoriteShopIds = $user ? Favorite::where('user_id', $user->id)->pluck('shop_id')->toArray() : [];

        // お気に入りの店舗情報を取得
        $favoriteShops = Shop::whereIn('id', $favoriteShopIds)->with('area', 'genre')->get();

        // 予約情報の店舗IDを取得
        $reservations = $user ? Reservation::where([
            ['user_id', $user->id],
            ['date', '>=', Carbon::today()],
        ])->with('shop')
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->get() : [];

        // 予約ごとにQRコードの生成を確認
        foreach ($reservations as $reservation) {
            if (!$reservation->qr_code_path) {
                // QRコード作成
                $qrCode = QrCode::create(route('reservation.checkin', ['id' => $reservation->id]));
                $writer = new PngWriter();
                $result = $writer->write($qrCode);

                // QRコードをストレージに保存
                $filePath = 'qrcodes/' . $reservation->id . '.png';
                Storage::disk('public')->put($filePath, $result->getString());

                // 予約情報にQRコードのパスを保存
                $reservation->qr_code_path = $filePath;
                $reservation->save();
            }
        }

        return view('mypage', compact('user', 'favoriteShops', 'favoriteShopIds', 'reservations'));
    }

    public function showQrCode($id)
    {
        $user = Auth::user();

        $reservation = Reservation::find($id);

        // 来店フラグがすでに更新されているか確認
        if ($reservation->visited) {
            return redirect()->route('mypage')->with('flash_message', 'すでにチェックイン済みです。');
        }

        // QRコードの画像を表示する
        return response()->file(storage_path('app/public/' . $reservation->qr_code_path));
    }


    public function checkin($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            abort(404, 'Reservation not found');
        }

        // 来店フラグがすでに更新されているか確認
        if ($reservation->visited) {
            return redirect()->route('mypage')->with('alert', 'すでにチェックイン済みです。');
        }

        // 来店フラグを更新
        $reservation->visited = true;
        $reservation->save();

        // 来店確認メッセージを表示し、マイページにリダイレクト
        return redirect()->route('mypage')->with('alert', '来店確認が完了しました！');
    }
}
