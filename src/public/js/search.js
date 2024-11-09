document.addEventListener("DOMContentLoaded", function () {
    const areaSelect = document.getElementById("area");
    const genreSelect = document.getElementById("genre");
    const shopNameInput = document.getElementById("shop-name");
    const shopCards = document.querySelectorAll(".shop-card");

    function filterShops() {
        const selectedArea = areaSelect.value;
        const selectedGenre = genreSelect.value;
        const shopNameFilter = shopNameInput.value.toLowerCase();

        shopCards.forEach(function (card) {
            const areaId = card.dataset.areaId;
            const genreId = card.dataset.genreId;
            const shopName = card
                .querySelector(".shop-card__shop-name")
                .textContent.toLowerCase();

            const matchesArea =
                !selectedArea ||
                selectedArea === "all" ||
                areaId === selectedArea;
            const matchesGenre =
                !selectedGenre ||
                selectedGenre === "all" ||
                genreId === selectedGenre;
            const matchesShopName =
                !shopNameFilter || shopName.includes(shopNameFilter);

            if (
                (!selectedArea || selectedArea === "all") &&
                (!selectedGenre || selectedGenre === "all") &&
                !shopNameFilter
            ) {
                card.style.display = "";
            } else if (
                (!selectedArea || selectedArea === "all") &&
                (!selectedGenre || selectedGenre === "all") &&
                matchesShopName
            ) {
                card.style.display = matchesShopName ? "" : "none";
            } else if (
                (!selectedArea || selectedArea === "all") &&
                matchesGenre &&
                matchesShopName
            ) {
                card.style.display =
                    matchesGenre && matchesShopName ? "" : "none";
            } else if (
                matchesArea &&
                (!selectedGenre || selectedGenre === "all") &&
                matchesShopName
            ) {
                card.style.display =
                    matchesArea && matchesShopName ? "" : "none";
            } else if (matchesArea && matchesGenre && !shopNameFilter) {
                card.style.display = matchesArea && matchesGenre ? "" : "none";
            } else if (matchesArea && matchesGenre && matchesShopName) {
                card.style.display =
                    matchesArea && matchesGenre && matchesShopName
                        ? ""
                        : "none";
            } else {
                card.style.display = "none";
            }
        });
    }

    areaSelect.addEventListener("change", filterShops);
    genreSelect.addEventListener("change", filterShops);
    shopNameInput.addEventListener("input", filterShops);

    shopCards.forEach(function (card) {
        card.style.display = "";
    });
});
