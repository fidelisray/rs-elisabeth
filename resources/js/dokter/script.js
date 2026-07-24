import { fetchAllDokter, fetchDokterBySpecialtyCode, filterDoctors, state } from './dokterService.js';
import { renderDoctorPage, renderModal, showLoading, showError } from './dokterUI.js';

// Elements
const clinicSearch = document.getElementById("clinicSearch");
const clinicOptions = document.querySelectorAll(".clinic-option");
const dropdownButton = document.getElementById("clinicDropdown");
const searchInput = document.getElementById("searchKeyword");
const detailDokterModal = document.getElementById("detailDokter");

// Initialization
document.addEventListener("DOMContentLoaded", async () => {
    showLoading();

    // Parse URL Parameters
    const urlParams = new URLSearchParams(window.location.search);
    const specialtyCode = urlParams.get('specialty_code');
    const nama = urlParams.get('nama');

    let fetchSuccess = false;

    if (specialtyCode) {
        // Find the clinic option to get the name
        const option = Array.from(clinicOptions).find(opt => opt.dataset.code === specialtyCode);
        if (option && dropdownButton) {
            dropdownButton.innerText = option.dataset.value;
            dropdownButton.dataset.selected_name = option.dataset.value;
            dropdownButton.dataset.selected_code = specialtyCode;
        }
        
        fetchSuccess = await fetchDokterBySpecialtyCode(specialtyCode);
    } else {
        fetchSuccess = await fetchAllDokter();
    }

    if (fetchSuccess) {
        if (nama) {
            if (searchInput) searchInput.value = nama;
            filterDoctors(nama.toLowerCase());
        }
        renderDoctorPage(handlePageChange);
    } else {
        showError();
    }
});

// Callback for pagination
function handlePageChange(newPage) {
    state.currentPage = newPage;
    renderDoctorPage(handlePageChange);
    const container = document.getElementById("daftar-dokter");
    if (container) {
        container.scrollIntoView({ behavior: "smooth", block: "start" });
    }
}

// ------------------------------
// Search Keyword Debounce
// ------------------------------
let searchDebounceTimer;
if (searchInput) {
    searchInput.addEventListener("keyup", function () {
        clearTimeout(searchDebounceTimer);
        searchDebounceTimer = setTimeout(() => {
            const keyword = this.value.trim().toLowerCase();
            filterDoctors(keyword);
            renderDoctorPage(handlePageChange);
        }, 400);
    });
}

// ------------------------------
// Dropdown Pilih Klinik
// ------------------------------
if (clinicSearch) {
    clinicSearch.addEventListener("keyup", function () {
        const keyword = this.value.toLowerCase();
        clinicOptions.forEach((option) => {
            const clinicName = option.textContent.toLowerCase();
            option.style.display = clinicName.includes(keyword) ? "block" : "none";
        });
    });
}

clinicOptions.forEach((option) => {
    option.addEventListener("click", async function () {
        const selected_name = this.dataset.value;
        const selected_code = this.dataset.code;

        if (dropdownButton) {
            dropdownButton.innerText = selected_name;
            dropdownButton.dataset.selected_name = selected_name;
            dropdownButton.dataset.selected_code = selected_code;
        }

        // Fetch doctors by clinic
        showLoading();
        const success = await fetchDokterBySpecialtyCode(selected_code);
        if (success) {
            if (searchInput) searchInput.value = "";
            renderDoctorPage(handlePageChange);
        } else {
            showError();
        }
    });
});

// ------------------------------
// Reset Button
// ------------------------------
const btnReset = document.getElementById("btnReset");
if (btnReset) {
    btnReset.addEventListener("click", async () => {
        if (dropdownButton) {
            dropdownButton.innerText = "Pilih Spesialisasi";
            dropdownButton.dataset.selected_name = "";
            dropdownButton.dataset.selected_code = "";
        }

        if (clinicSearch) clinicSearch.value = "";
        if (searchInput) searchInput.value = "";

        clinicOptions.forEach((option) => {
            option.style.display = "block";
        });

        showLoading();
        const success = await fetchAllDokter();
        if (success) {
            renderDoctorPage(handlePageChange);
        } else {
            showError();
        }
    });
}

// ------------------------------
// Cari Button (if used, it's hidden by default in blade)
// ------------------------------
const btnCari = document.getElementById("btnCari");
if (btnCari) {
    btnCari.addEventListener("click", () => {
        const clinic_code = dropdownButton?.dataset.selected_code;
        if (clinic_code) {
            window.location.href = `/dokter/${clinic_code}`;
        }
    });
}

// ------------------------------
// Modal Event Listeners
// ------------------------------
if (detailDokterModal) {
    detailDokterModal.addEventListener("show.bs.modal", (event) => {
        const button = event.relatedTarget;
        const id = button.dataset.id;
        const doctor = state.filteredDoctorList.find((item) => item.entry_id === id);
        if (doctor) {
            renderModal(doctor);
        }
    });

    detailDokterModal.addEventListener("hidden.bs.modal", function () {
        // Reset tabs
        document.getElementById("tentang-tab")?.classList.add("active");
        document.getElementById("jadwal-tab")?.classList.remove("active");
        document.getElementById("tentang-pane")?.classList.add("show", "active");
        document.getElementById("jadwal-pane")?.classList.remove("show", "active");
    });
}

// ------------------------------
// Buat Janji Buttons
// ------------------------------
document.addEventListener("click", function(event) {
    if (event.target.closest(".button-janji") || event.target.closest(".btn-buat-janji")) {
        window.open("https://regonline.rs-elisabeth.com/", "_blank");
    }
});
