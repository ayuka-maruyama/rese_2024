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

            if (button.style.color === "red") {
                button.style.color = "gray";
            } else {
                button.style.color = "red";
            }

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
                .then((response) => response.json())
                .then((data) => {
                    console.log("Server response:", data);
                })
                .catch((error) => console.error("Error:", error));
        });
    });
});
