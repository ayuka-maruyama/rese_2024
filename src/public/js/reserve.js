document.addEventListener("DOMContentLoaded", function () {
    const datePicker = document.getElementById("date-picker");
    const dateInput = document.getElementById("date");
    const today = new Date();

    function dateFormat(today, format) {
        format = format.replace("YYYY", today.getFullYear());
        format = format.replace("MM", ("0" + (today.getMonth() + 1)).slice(-2));
        format = format.replace("DD", ("0" + today.getDate()).slice(-2));
        return format;
    }

    const todayFormatted = dateFormat(today, "YYYY-MM-DD");
    dateInput.setAttribute("min", todayFormatted);

    datePicker.addEventListener("click", function () {
        dateInput.readOnly = false;
        dateInput.showPicker();
        dateInput.readOnly = true;
    });

    const timePicker = document.getElementById("time-picker");
    const timeSelect = document.getElementById("time");
    timePicker.addEventListener("click", function () {
        timeSelect.focus();
    });

    const gestPicker = document.getElementById("gest-picker");
    const gestSelect = document.getElementById("number_gest");
    gestPicker.addEventListener("click", function () {
        gestSelect.focus();
    });

    const shopNameElement = document.querySelector(".shop-name").textContent;
    const reserveDetailElement = document.querySelector(".reserve-detail");
    const dateDisplay = document.getElementById("date");
    const timeDisplay = document.getElementById("time");
    const gestDisplay = document.getElementById("number_gest");

    function generateTimeOptions(selectedDate) {
        const startTime = new Date();
        startTime.setHours(11, 0, 0);
        const endTime = new Date();
        endTime.setHours(22, 0, 0);

        const isToday = selectedDate === todayFormatted;
        timeSelect.innerHTML = "";

        for (
            let time = new Date(startTime);
            time <= endTime;
            time.setMinutes(time.getMinutes() + 30)
        ) {
            const option = document.createElement("option");
            const timeFormatted = time.toTimeString().slice(0, 5);

            if (isToday && time <= today) {
                option.disabled = true;
            }

            option.value = timeFormatted;
            option.text = timeFormatted;
            timeSelect.appendChild(option);
        }
    }

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

    dateInput.addEventListener("change", function () {
        const selectedDate = dateInput.value;
        generateTimeOptions(selectedDate);
        updateReservationDetails();
    });

    timeSelect.addEventListener("change", updateReservationDetails);
    gestSelect.addEventListener("change", updateReservationDetails);

    generateTimeOptions(todayFormatted);
    updateReservationDetails();
});
