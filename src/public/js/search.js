document.addEventListener("DOMContentLoaded", function () {
    const areaSelect = document.getElementById("area");
    const genreSelect = document.getElementById("genre");
    const shopNameInput = document.getElementById("shop-name");
    const sortSelect = document.getElementById("sort");
    const shopCards = document.querySelectorAll(".shop-card");
    const shopContainer = document.getElementById("shop-container");
    const sortInfoValue = document.getElementById("sort-info-value");

    if (!shopContainer) {
        console.error("Error: shop-container not found in the DOM");
        return;
    }

    if (!sortSelect) {
        console.error("Error: sort select box not found in the DOM");
        return;
    }

    // 並び替えの選択肢が変更されたときの処理
    sortSelect.addEventListener("change", function () {
        const selectedSort =
            sortSelect.options[sortSelect.selectedIndex].textContent;
        sortInfoValue.textContent = selectedSort; // 選択された並び替えの名前を表示
    });

    // 初期状態での並び替え情報を表示（選択されているもの）
    sortInfoValue.textContent =
        sortSelect.options[sortSelect.selectedIndex].textContent;

    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function filterAndSortShops() {
        const selectedArea = areaSelect.value;
        const selectedGenre = genreSelect.value;
        const shopNameFilter = shopNameInput.value.toLowerCase();
        const sortOption = sortSelect.value;

        const shopsArray = Array.from(shopCards);

        if (sortOption === "highly-rated") {
            shopsArray.sort((a, b) => {
                const ratingA = parseFloat(a.dataset.rating) || 0;
                const ratingB = parseFloat(b.dataset.rating) || 0;

                // 0.00の評価は最後に
                if (ratingA === 0 && ratingB !== 0) return 1;
                if (ratingB === 0 && ratingA !== 0) return -1;

                return ratingB - ratingA; // 高評価順
            });
        } else if (sortOption === "low-rated") {
            shopsArray.sort((a, b) => {
                const ratingA = parseFloat(a.dataset.rating) || 0;
                const ratingB = parseFloat(b.dataset.rating) || 0;

                // 0.00の評価は最後に
                if (ratingA === 0 && ratingB !== 0) return 1;
                if (ratingB === 0 && ratingA !== 0) return -1;

                return ratingA - ratingB; // 低評価順
            });
        } else if (sortOption === "random") {
            shuffleArray(shopsArray);
        }

        shopsArray.forEach(function (card) {
            const areaId = card.dataset.areaId || "";
            const genreId = card.dataset.genreId || "";
            const shopNameElement = card.querySelector(".shop-card__shop-name");
            const shopName = shopNameElement
                ? shopNameElement.textContent.toLowerCase()
                : "";

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

            card.style.display =
                matchesArea && matchesGenre && matchesShopName ? "" : "none";
        });

        shopContainer.innerHTML = ""; // 既存の要素をクリア
        shopsArray.forEach((shop) => shopContainer.appendChild(shop));
    }

    areaSelect.addEventListener("change", filterAndSortShops);
    genreSelect.addEventListener("change", filterAndSortShops);
    shopNameInput.addEventListener("input", filterAndSortShops);
    sortSelect.addEventListener("change", filterAndSortShops);

    shopCards.forEach((card) => (card.style.display = ""));
});
