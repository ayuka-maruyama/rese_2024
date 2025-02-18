document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star");
    const ratingInput = document.getElementById("rating-value");
    const commentInput = document.querySelector("textarea[name='comment']");
    const form = document.getElementById("evaluation-form");

    // 文字数表示用の要素を追加
    const charCountDisplay = document.createElement("p");
    charCountDisplay.id = "js_char-count";
    charCountDisplay.className = "char-count";
    charCountDisplay.textContent = "0 / 400文字（最高文字数）";
    commentInput.parentNode.insertBefore(
        charCountDisplay,
        commentInput.nextSibling
    );

    // 警告メッセージ用の要素を追加
    const warningMessage = document.createElement("p");
    warningMessage.id = "warning-message";
    warningMessage.style.color = "red";
    warningMessage.style.display = "none";
    warningMessage.textContent = "400文字を超えています！";
    commentInput.parentNode.insertBefore(
        warningMessage,
        charCountDisplay.nextSibling
    );

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

    // コメントのリアルタイム文字数カウント
    commentInput.addEventListener("input", function () {
        const charCount = this.value.length;
        charCountDisplay.textContent = `${charCount} / 400文字`;

        if (charCount > 400) {
            warningMessage.style.display = "block"; // 警告メッセージを表示
        } else {
            warningMessage.style.display = "none"; // 警告メッセージを非表示
        }
    });

    form.addEventListener("submit", function (event) {
        let errorMessages = [];

        if (!ratingInput.value) {
            errorMessages.push("評価を選択してください。");
        }

        if (!commentInput.value.trim()) {
            errorMessages.push("コメントを入力してください。");
        } else if (commentInput.value.length < 10) {
            errorMessages.push("コメントは10文字以上入力してください。");
        } else if (commentInput.value.length > 400) {
            errorMessages.push("コメントは400文字以内で入力してください。");
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
