document.addEventListener("DOMContentLoaded", function () {
    const menuButton = document.querySelector(".menu-button");
    const menu = document.querySelector(".menu");

    menuButton.addEventListener("click", function () {
        menu.classList.toggle("menu--open");
        menuButton.classList.toggle("menu--open");
        document.body.classList.toggle("no-scroll");
    });
});
