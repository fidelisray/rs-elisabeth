import { initializeDoctor } from "./dokter";

// *******************************
// ---- Dropdown Pilih Klinik ----
// *******************************
const clinicSearch = document.getElementById("clinicSearch");
const clinicOptions = document.querySelectorAll(".clinic-option");
const dropdownButton = document.getElementById("clinicDropdown");

// Filter Klinik

clinicSearch.addEventListener("keyup", function () {
    const keyword = this.value.toLowerCase();

    clinicOptions.forEach((option) => {
        const clinicName = option.textContent.toLowerCase();
        option.style.display = clinicName.includes(keyword) ? "block" : "none";
    });
});

// Pilih Klinik

clinicOptions.forEach((option) => {
    option.addEventListener("click", function () {
        const selected_name = this.dataset.value;
        const selected_code = this.dataset.code;

        dropdownButton.innerText = selected_name;
        dropdownButton.dataset.selected_name = selected_name;
        dropdownButton.dataset.selected_code = selected_code;
    });
});

// Reset

document.getElementById("btnReset").addEventListener("click", () => {
    dropdownButton.innerText = "Pilih Klinik";

    // dropdownButton.dataset.selected = '';
    dropdownButton.dataset.selected_name = "";
    dropdownButton.dataset.selected_code = "";

    clinicSearch.value = "";

    document.getElementById("searchKeyword").value = "";

    clinicOptions.forEach((option) => {
        option.style.display = "block";
    });

    initializeDoctor();
});

// Cari

document.getElementById("btnCari").addEventListener("click", () => {
    const clinic_name = dropdownButton.dataset.selected_name;
    const clinic_code = dropdownButton.dataset.selected_code;
    // const clinic = dropdownButton.dataset.selected;

    const keyword = document.getElementById("searchKeyword").value;

    console.log({ clinic_name, clinic_code, keyword });

    window.location.href = `/dokter/${clinic_code}`;
});

// button janji
const buttonJanji = document.getElementsByClassName("button-janji");

buttonJanji[0].addEventListener("click", () => {
    window.open("https://regonline.rs-elisabeth.com/", "_blank");
});
buttonJanji[1].addEventListener("click", () => {
    window.open("https://regonline.rs-elisabeth.com/", "_blank");
});
