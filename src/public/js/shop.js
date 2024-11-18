document.addEventListener("DOMContentLoaded", function () {
    const isLoggedIn =
        document.body.getAttribute("data-is-logged-in") === "true";

    const favoriteButtons = document.querySelectorAll(".favorite-btn");

    favoriteButtons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            if (!isLoggedIn) {
                window.location.href = "/login";
                return;
            }

            const shopId = button.getAttribute("data-id");
            const isFavorited = button.classList.contains("favorited");

            // 仮状態としてUIを即時切り替え
            if (isFavorited) {
                button.classList.remove("favorited");
            } else {
                button.classList.add("favorited");
            }

            // サーバーにリクエストを送信
            fetch(`/favorite/${shopId}`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ shopId: shopId }),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("サーバーエラー");
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log("Server response:", data);
                })
                .catch((error) => {
                    console.error("Error:", error);

                    // エラー時に状態を元に戻す
                    if (isFavorited) {
                        button.classList.add("favorited");
                    } else {
                        button.classList.remove("favorited");
                    }
                });
        });
    });
});
