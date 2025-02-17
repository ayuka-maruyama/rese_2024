window.onload = function () {
    var successMessage = document.getElementById("success-message");
    if (successMessage) {
        setTimeout(function () {
            successMessage.style.display = "none";
        }, 3000);
    }
};
