document.addEventListener("DOMContentLoaded", function () {
    // カレンダー表示トリガー
    const datePicker = document.getElementById("date-picker");
    const dateInput = document.getElementById("date");
    const today = new Date();

    // 日付フォーマット関数
    function dateFormat(today, format) {
        format = format.replace("YYYY", today.getFullYear());
        format = format.replace("MM", ("0" + (today.getMonth() + 1)).slice(-2));
        format = format.replace("DD", ("0" + today.getDate()).slice(-2));
        return format;
    }

    const todayFormatted = dateFormat(today, "YYYY-MM-DD");
    dateInput.setAttribute("min", todayFormatted);

    // カレンダーを表示
    datePicker.addEventListener("click", function () {
        dateInput.readOnly = false;
        dateInput.showPicker();
        dateInput.readOnly = true;
    });

    // 時間選択ドロップダウン表示トリガー
    const timePicker = document.getElementById("time-picker");
    const timeSelect = document.getElementById("time");
    timePicker.addEventListener("click", function () {
        timeSelect.focus();
    });

    // ゲスト数選択ドロップダウン表示トリガー
    const gestPicker = document.getElementById("gest-picker");
    const gestSelect = document.getElementById("number_gest");
    gestPicker.addEventListener("click", function () {
        gestSelect.focus();
    });

    // 選択された値を表示するための要素を取得
    const shopNameElement = document.querySelector(".shop-name").textContent;
    const reserveDetailElement = document.querySelector(".reserve-detail");
    const dateDisplay = document.getElementById("date");
    const timeDisplay = document.getElementById("time");
    const gestDisplay = document.getElementById("number_gest");

    // 時間オプションを動的に生成する関数
    function generateTimeOptions(selectedDate) {
        const startTime = new Date();
        startTime.setHours(11, 0, 0); // AM 11:00
        const endTime = new Date();
        endTime.setHours(22, 0, 0); // PM 10:00

        const isToday = selectedDate === todayFormatted;
        timeSelect.innerHTML = ""; // 既存のオプションをクリア

        for (
            let time = new Date(startTime);
            time <= endTime;
            time.setMinutes(time.getMinutes() + 30)
        ) {
            const option = document.createElement("option");
            const timeFormatted = time.toTimeString().slice(0, 5);

            if (isToday && time <= today) {
                option.disabled = true; // 過去の時間は選択不可にする
            }

            option.value = timeFormatted;
            option.text = timeFormatted;
            timeSelect.appendChild(option);
        }
    }

    // 予約内容を表示
    function updateReservationDetails() {
        reserveDetailElement.innerHTML = `
            <table class="reserve__table">
                <tr>
                    <th>Shop</th>
                    <td>${shopNameElement}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>${dateDisplay.value}</td>
                </tr>
                <tr>
                    <th>Time</th>
                    <td>${timeDisplay.value}</td>
                </tr>
                <tr>
                    <th>Number</th>
                    <td>${gestDisplay.value}</td>
                </tr>
            </table>
        `;
    }

    // 日付が変更されたときに時間オプションを更新
    dateInput.addEventListener("change", function () {
        const selectedDate = dateInput.value;
        generateTimeOptions(selectedDate);
        updateReservationDetails(); // 予約内容も更新
    });

    // 時間、ゲスト数が変更されたときに予約情報を更新
    timeSelect.addEventListener("change", updateReservationDetails);
    gestSelect.addEventListener("change", updateReservationDetails);

    // 初期表示時の処理
    generateTimeOptions(todayFormatted); // 時刻オプションを生成
    updateReservationDetails(); // 予約情報を初期表示

});
