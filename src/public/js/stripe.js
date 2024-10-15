document.addEventListener("DOMContentLoaded", function () {
    // Bladeテンプレートから渡された公開可能キーを使用
    const stripe = Stripe(stripePublicKey);
    const elements = stripe.elements();

    // カード入力フィールドのスタイル設定
    const style = {
        base: {
            color: "#32325d",
            fontFamily: "Arial, sans-serif",
            fontSize: "16px",
            "::placeholder": {
                color: "#aab7c4",
            },
        },
        invalid: {
            color: "#fa755a",
            iconColor: "#fa755a",
        },
    };

    // カード要素の作成
    const card = elements.create("card", { style: style });
    card.mount("#card-element");

    // カード情報が変わるたびにエラーメッセージを表示
    card.on("change", function (event) {
        const displayError = document.getElementById("card-errors");
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = "";
        }
    });

    // フォーム送信時にトークンを生成し、サーバーに送信
    const form = document.getElementById("payment-form");
    form.addEventListener("submit", function (event) {
        event.preventDefault();

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                // エラーメッセージを表示
                const errorElement = document.getElementById("card-errors");
                errorElement.textContent = result.error.message;
            } else {
                // トークンをサーバーに送信
                stripeTokenHandler(result.token);
            }
        });
    });

    // トークンをサーバーに送信する
    function stripeTokenHandler(token) {
        // トークンをフォームに埋め込む
        const form = document.getElementById("payment-form");
        const hiddenInput = document.createElement("input");
        hiddenInput.setAttribute("type", "hidden");
        hiddenInput.setAttribute("name", "stripeToken");
        hiddenInput.setAttribute("value", token.id);
        form.appendChild(hiddenInput);

        // フォームを送信
        form.submit();
    }
});
