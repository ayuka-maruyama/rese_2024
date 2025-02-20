document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star");
    const ratingInput = document.getElementById("rating-value");
    const commentInput = document.querySelector("textarea[name='comment']");
    const form = document.getElementById("evaluation-form");
    const imageInput = document.getElementById("image");
    const imageFileNameInput = document.getElementById("image-file-name");
    const imagePreview = document.getElementById("image-preview");
    const fileUploadLabel = document.querySelector("label[for='image']"); // 画像のラベル

    // 既存の評価を取得（Laravelから渡された値）
    const existingEvaluation = parseInt(ratingInput.value, 10) || 0;

    // 初期状態の★をセット
    updateStars(existingEvaluation);

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

    // 文字数カウント表示の追加
    const charCountDisplay = document.createElement("p");
    charCountDisplay.id = "js_char-count";
    charCountDisplay.className = "char-count";
    charCountDisplay.textContent = "0 / 400文字（最高文字数）";
    commentInput.parentNode.insertBefore(
        charCountDisplay,
        commentInput.nextSibling
    );

    const warningMessage = document.createElement("p");
    warningMessage.id = "warning-message";
    warningMessage.style.color = "red";
    warningMessage.style.display = "none";
    warningMessage.textContent = "400文字を超えています！";
    commentInput.parentNode.insertBefore(
        warningMessage,
        charCountDisplay.nextSibling
    );

    // 初期状態の文字数カウント
    const initialCharCount = commentInput.value.length;
    charCountDisplay.textContent = `${initialCharCount} / 400文字（最高文字数）`;

    commentInput.addEventListener("input", function () {
        const charCount = this.value.length;
        charCountDisplay.textContent = `${charCount} / 400文字`;

        if (charCount > 400) {
            warningMessage.style.display = "block";
        } else {
            warningMessage.style.display = "none";
        }
    });

    // フォーム送信時に textarea の値を hidden input にコピー
    form.addEventListener("submit", function () {
        const hiddenComment = document.getElementById("hidden-comment");
        hiddenComment.value = commentInput.value;
    });

    // 画像ファイルが選択された際、プレビューを更新し、ファイル名を hidden input に設定
    imageInput.addEventListener("change", function () {
        const file = imageInput.files[0];
        if (file) {
            // プレビューの表示
            const reader = new FileReader();
            reader.onload = function (e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = "block"; // プレビュー画像を表示
            };
            reader.readAsDataURL(file);

            // ファイル名を hidden input に設定
            imageFileNameInput.value = file.name;

            // ラベルを非表示にする
            fileUploadLabel.style.display = "none";
        } else {
            // 画像が選択されていない場合、プレビューを非表示
            imagePreview.style.display = "none";
            fileUploadLabel.style.display = "block"; // ラベルを再表示
        }
    });

    // 画像プレビューをクリックすると画像選択ダイアログを再度開く
    imagePreview.addEventListener("click", function () {
        imageInput.click(); // 画像選択ダイアログを開く
    });
});
