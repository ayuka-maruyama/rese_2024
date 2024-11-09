document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star");
    const ratingInput = document.getElementById("rating-value");
    const commentInput = document.querySelector("textarea[name='comment']");
    const form = document.getElementById("evaluation-form");

    // 星をクリックしたときの処理
    stars.forEach(function (star) {
        star.addEventListener("click", function () {
            const value = this.getAttribute("data-value");
            ratingInput.value = value;
            updateStars(value);
            console.log(`選択された評価: ${value}`);
        });
    });

    function updateStars(value) {
        stars.forEach(function (star) {
            if (star.getAttribute("data-value") <= value) {
                star.classList.add("selected");
            } else {
                star.classList.remove("selected");
            }
        });
    }

    form.addEventListener("submit", function (event) {
        let errorMessages = [];

        if (!ratingInput.value) {
            errorMessages.push("評価を選択してください。");
        }

        if (!commentInput.value.trim()) {
            errorMessages.push("コメントを入力してください。");
        } else if (commentInput.value.length < 10) {
            errorMessages.push("コメントは10文字以上入力してください。");
        }

        if (errorMessages.length > 0) {
            alert(errorMessages.join("\n"));
            event.preventDefault();
        } else {
            console.log(`送信される評価: ${ratingInput.value}`);
            console.log(`送信されるコメント: ${commentInput.value}`);
        }
    });
});
