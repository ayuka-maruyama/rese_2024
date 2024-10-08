document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star"); // 複数の星を取得
    const ratingInput = document.getElementById("rating-value"); // hidden inputを取得

    stars.forEach(function (star) {
        star.addEventListener("click", function (event) {
            event.preventDefault(); // フォーム送信を防止

            const value = this.getAttribute("data-value"); // クリックした星の評価値を取得
            ratingInput.value = value; // hidden inputのvalueを更新
            updateStars(value); // 星の表示を更新
        });
    });

    function updateStars(value) {
        stars.forEach(function (star) {
            if (star.getAttribute("data-value") <= value) {
                star.classList.add("selected"); // 評価がクリックされた星までの色を変更
            } else {
                star.classList.remove("selected"); // それ以降の星は色を戻す
            }
        });
    }
});
