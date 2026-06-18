import { initDokter } from "./dokter";

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

    initDokter();
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

// modal dokter
const detailDokter = document.getElementById("detailDokter");
// console.log(detailDokter);

detailDokter.addEventListener("show.bs.modal", (event) => {
    const button = event.relatedTarget;

    const namaDokter = button.dataset.nama;
    const jadwalDokter = JSON.parse(button.dataset.jadwal);
    const fotoDokter = document.getElementById("foto-dokter");

    fotoDokter.innerHTML = `
        <img src="https://mobile.rs-elisabeth.com/paramedic/${button.dataset.id}.png" alt="Doctor">
    `;

    document.getElementById("namaDokter").textContent = namaDokter;

    let scheduleCard = "";

    jadwalDokter.forEach((jadwal) => {
        let scheduleTime = "";
        jadwal.jam.map((waktu) => {
            scheduleTime += `
                <span class="schedule-time">${waktu}</span>
            `;
        });
        scheduleCard += `
            <div class="col-12 col-lg-4">    
                <div class="schedule-card">
                    <div class="day-badge">${jadwal.hari}</div>

                    <div>
                        <div class="schedule-day">${jadwal.hari}</div>
                        ${scheduleTime}
                    </div>
                </div>
            </div>
        `;
    });

    document.getElementById("schedule-cards").innerHTML = scheduleCard;
});

// button janji
const buttonJanji = document.getElementsByClassName("button-janji");

buttonJanji[0].addEventListener("click", () => {
    window.open("https://regonline.rs-elisabeth.com/", "_blank");
});
buttonJanji[1].addEventListener("click", () => {
    window.open("https://regonline.rs-elisabeth.com/", "_blank");
});
