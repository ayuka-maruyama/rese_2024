document.addEventListener("DOMContentLoaded", function () {
    const stripe = Stripe(stripePublicKey);
    const elements = stripe.elements();

    const style = {
        base: {
            color: "#32325d",
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: "antialiased",
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

    const cardNumberElement = elements.create("cardNumber", { style: style });
    cardNumberElement.mount("#card-number");

    const cardExpiryElement = elements.create("cardExpiry", { style: style });
    cardExpiryElement.mount("#card-expiry");

    const cardCvcElement = elements.create("cardCvc", { style: style });
    cardCvcElement.mount("#card-cvc");

    const cardBrandLogoElement = document.getElementById("card-brand-logo");
    const errorElement = document.getElementById("card-errors");

    cardNumberElement.on("change", function (event) {
        if (event.error) {
            errorElement.textContent = event.error.message;
        } else {
            errorElement.textContent = "";
        }

        if (event.brand) {
            const logoUrl = getCardBrandLogo(event.brand);
            if (logoUrl) {
                cardBrandLogoElement.src = logoUrl;
                cardBrandLogoElement.style.display = "inline";
            } else {
                cardBrandLogoElement.style.display = "none";
            }
        } else {
            cardBrandLogoElement.style.display = "none";
        }
    });

    function getCardBrandLogo(brand) {
        switch (brand) {
            case "visa":
                return "/img/brands/visa.png";
            case "mastercard":
                return "/img/brands/mastercard.png";
            case "amex":
                return "/img/brands/amex.png";
            case "discover":
                return "/img/brands/discover.png";
            case "jcb":
                return "/img/brands/jcb.png";
            default:
                return null;
        }
    }

    const form = document.getElementById("payment-form");
    form.addEventListener("submit", function (event) {
        event.preventDefault();

        stripe.createToken(cardNumberElement).then(function (result) {
            if (result.error) {
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        const hiddenInput = document.createElement("input");
        hiddenInput.setAttribute("type", "hidden");
        hiddenInput.setAttribute("name", "stripeToken");
        hiddenInput.setAttribute("value", token.id);
        form.appendChild(hiddenInput);

        form.submit();
    }
});
