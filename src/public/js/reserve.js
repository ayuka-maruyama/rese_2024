document.addEventListener('DOMContentLoaded', function() {
    // カレンダー表示トリガー
    const datePicker = document.getElementById('date-picker');
    const dateInput = document.getElementById('date');
    
    datePicker.addEventListener('click', function() {
        dateInput.readOnly = false;  // readonly を一時的に解除
        dateInput.showPicker();      // カレンダー表示
        dateInput.readOnly = true;   // readonly を再度設定
    });

    // 時間選択ドロップダウン表示トリガー
    const timePicker = document.getElementById('time-picker');
    const timeSelect = document.getElementById('time');
    timePicker.addEventListener('click', function() {
        timeSelect.focus(); // ドロップダウン表示
    });

    // ゲスト数選択ドロップダウン表示トリガー
    const gestPicker = document.getElementById('gest-picker');
    const gestSelect = document.getElementById('gest');
    gestPicker.addEventListener('click', function() {
        gestSelect.focus(); // ドロップダウン表示
    });

    // 選択された値を表示するための要素を取得
    const shopNameElement = document.querySelector('.shop-name').textContent;
    const reserveDetailElement = document.querySelector('.reserve-detail');
    const dateDisplay = document.getElementById('date');
    const timeDisplay = document.getElementById('time');
    const gestDisplay = document.getElementById('gest');

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

    // 日付、時間、ゲスト数が変更されたときに予約情報を更新
    dateInput.addEventListener('change', updateReservationDetails);
    timeSelect.addEventListener('change', updateReservationDetails);
    gestSelect.addEventListener('change', updateReservationDetails);

    // 初期表示
    updateReservationDetails();
});
