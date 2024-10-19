window.onload = function () {
    // QRコードをスキャンしたらウィンドウを閉じる処理を実装（仮に5秒後に閉じる例）
    setTimeout(function () {
        // 親ウィンドウにメッセージを送信
        window.opener.postMessage("checkin_complete", "*");

        // 現在のウィンドウを閉じる
        window.close();
    }, 5000); // 5秒後に実行される
};
