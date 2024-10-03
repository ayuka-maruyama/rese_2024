document.addEventListener("DOMContentLoaded", function () {
    const areaSelect = document.getElementById("area"); // エリアのセレクトボックス
    const genreSelect = document.getElementById("genre"); // ジャンルのセレクトボックス
    const shopNameInput = document.getElementById("shop-name"); // 店名の入力フィールド
    const shopCards = document.querySelectorAll(".shop-card"); // お店のカード

    // ショップをフィルタリングする関数
    function filterShops() {
        const selectedArea = areaSelect.value; // 選択されたエリアのID
        const selectedGenre = genreSelect.value; // 選択されたジャンルのID
        const shopNameFilter = shopNameInput.value.toLowerCase(); // 店名フィルター（小文字に変換）

        shopCards.forEach(function (card) {
            const areaId = card.dataset.areaId; // 各カードのエリアIDを取得
            const genreId = card.dataset.genreId; // 各カードのジャンルIDを取得
            const shopName = card
                .querySelector(".shop-card__shop-name")
                .textContent.toLowerCase(); // 店名を取得

            // 条件をチェック
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

            // 各パターンに応じたフィルタリング
            if (
                (!selectedArea || selectedArea === "all") &&
                (!selectedGenre || selectedGenre === "all") &&
                !shopNameFilter
            ) {
                // すべて未指定の場合は全て表示
                card.style.display = "";
            } else if (
                (!selectedArea || selectedArea === "all") &&
                (!selectedGenre || selectedGenre === "all") &&
                matchesShopName
            ) {
                // エリアもジャンルも「All」が選択され、店名が入力された場合
                card.style.display = matchesShopName ? "" : "none";
            } else if (
                (!selectedArea || selectedArea === "all") &&
                matchesGenre &&
                matchesShopName
            ) {
                // エリアが「All」でジャンルと店名に基づくフィルタリング
                card.style.display =
                    matchesGenre && matchesShopName ? "" : "none";
            } else if (
                matchesArea &&
                (!selectedGenre || selectedGenre === "all") &&
                matchesShopName
            ) {
                // ジャンルが「All」でエリアと店名に基づくフィルタリング
                card.style.display =
                    matchesArea && matchesShopName ? "" : "none";
            } else if (matchesArea && matchesGenre && !shopNameFilter) {
                // エリアとジャンルでフィルタリング、店名は入力されていない場合
                card.style.display = matchesArea && matchesGenre ? "" : "none";
            } else if (matchesArea && matchesGenre && matchesShopName) {
                // エリア、ジャンル、店名のすべてに合致する場合
                card.style.display =
                    matchesArea && matchesGenre && matchesShopName
                        ? ""
                        : "none";
            } else {
                card.style.display = "none"; // 該当なし
            }
        });
    }

    // イベントリスナーの追加
    areaSelect.addEventListener("change", filterShops);
    genreSelect.addEventListener("change", filterShops);
    shopNameInput.addEventListener("input", filterShops);

    // 初期表示は全件表示
    shopCards.forEach(function (card) {
        card.style.display = ""; // 全て表示
    });
});
