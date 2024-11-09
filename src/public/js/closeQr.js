window.onload = function () {
    setTimeout(function () {
        window.opener.postMessage("checkin_complete", "*");

        window.close();
    }, 5000);
};
