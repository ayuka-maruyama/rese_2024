const textarea = document.querySelector("textarea");
textarea.addEventListener("input", function () {
    this.style.height = "auto";
    this.style.height = this.scrollHeight + "px";
});

document.getElementById("image").addEventListener("change", function () {
    const fileName = this.files[0]
        ? this.files[0].name
        : "ファイルが選択されていません";
    document.getElementById("file-name").textContent = fileName;
});

document.getElementById("image").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const preview = document.getElementById("image-preview");
            preview.src = e.target.result;
            preview.style.display = "block";
        };

        reader.readAsDataURL(file);
    }
});
