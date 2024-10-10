document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star"); // 星の要素を取得
    const ratingInput = document.getElementById("rating-value"); // 評価を保持する隠しフィールド
    const commentInput = document.querySelector("textarea[name='comment']"); // コメント入力フィールド
    const form = document.getElementById("evaluation-form"); // フォームを取得

    // 星をクリックしたときの処理
    stars.forEach(function (star) {
        star.addEventListener("click", function () {
            const value = this.getAttribute("data-value"); // クリックされた星の値を取得
            ratingInput.value = value; // 隠しフィールドに評価値をセット
            updateStars(value); // 星をハイライト
            console.log(`選択された評価: ${value}`); // コンソールに表示
        });
    });

    // 星をハイライトする関数
    function updateStars(value) {
        stars.forEach(function (star) {
            if (star.getAttribute("data-value") <= value) {
                star.classList.add("selected"); // 選択された星にクラスを追加
            } else {
                star.classList.remove("selected"); // それ以外はクラスを削除
            }
        });
    }

    // フォーム送信時のバリデーション
    form.addEventListener("submit", function (event) {
        // エラーメッセージを保持する変数
        let errorMessages = [];

        // 評価が選択されていない場合のチェック
        if (!ratingInput.value) {
            errorMessages.push("評価を選択してください。");
        }

        // コメントが入力されていない場合のチェック
        if (!commentInput.value.trim()) {
            // 空白のみの場合も検出
            errorMessages.push("コメントを入力してください。");
        }

        // エラーメッセージがある場合は送信を防ぎ、アラート表示
        if (errorMessages.length > 0) {
            alert(errorMessages.join("\n")); // エラーメッセージをアラートで表示
            event.preventDefault(); // フォーム送信を防ぐ
        } else {
            console.log(`送信される評価: ${ratingInput.value}`);
            console.log(`送信されるコメント: ${commentInput.value}`);
        }
    });
});
