import { state } from './dokterService.js';

function getDayCardCount(daySchedule) {
    return daySchedule.reduce((total, item) => total + item.jam.length, 0);
}

function getMaxSlot(schedule) {
    return Math.max(...Object.values(schedule).map(getDayCardCount));
}

function createEmptyCard() {
    return `<div class="schedule-card empty-card"></div>`;
}

function createScheduleCard(jam, serviceUnitName) {
    return `
        <div class="schedule-card">
            <span class="sc-time">${jam}</span>
            <span class="sc-klinik">${serviceUnitName}</span>
        </div>
    `;
}

function renderHeaderHtml(schedule) {
    const hariIndonesia = {
        1: "Senin", 2: "Selasa", 3: "Rabu", 4: "Kamis", 5: "Jumat", 6: "Sabtu", 7: "Minggu",
    };
    const activeDays = state.days.filter((day) => schedule[day].length > 0);
    
    return activeDays.map(day => `<div class="day-header">${hariIndonesia[day]}</div>`).join("");
}

export function createScheduleGrid(dokter) {
    const schedule = dokter.schedule;
    const maxSlot = getMaxSlot(schedule);
    const activeDays = state.days.filter((day) => schedule[day].length > 0);
    
    let html = '';
    html += renderHeaderHtml(schedule);

    activeDays.forEach((day) => {
        let colHtml = `<div class="slot-col">`;
        schedule[day].forEach((item) => {
            item.jam.forEach((jam) => {
                colHtml += createScheduleCard(jam, item.serviceUnitName);
            });
        });
        
        const emptyCount = maxSlot - getDayCardCount(schedule[day]);
        for (let i = 0; i < emptyCount; i++) {
            colHtml += createEmptyCard();
        }
        colHtml += `</div>`;
        html += colHtml;
    });

    const gridStyle = `grid-template-columns: repeat(${activeDays.length}, minmax(120px, 1fr)); min-width: ${Math.max(activeDays.length, 4) * 130}px;`;
    return { html, gridStyle };
}

export function createDoctorCard(dokter) {
    return `
        <div class="card shadow-sm border-0 mb-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-12 col-md-3 border-end">
                        <div class="p-4 text-center">
                            <img
                                src="https://mobile.rs-elisabeth.com/paramedic/${dokter.paramedicCode}.png"
                                class="rounded-circle img-fluid mb-3"
                                style="width:180px;height:180px;object-fit:cover;"
                                alt="Foto Dokter"
                                onerror="this.onerror=null; this.src='/images/default.png';">
                            <span class="badge bg-primary mb-3 d-none">
                                    Spesialis Jantung
                            </span>
                            <div class="container my-3 group-btn">
                                <a 
                                    href='#' 
                                    class='btn-cek-profil'
                                    data-bs-toggle='modal'
                                    data-bs-target='#detailDokter'
                                    data-id='${dokter.entry_id}'
                                    data-jadwal=''>Cek Profil</a>
                                <a
                                    href='https://regonline.rs-elisabeth.com/'
                                    class='btn-buat-janji'
                                    target='_blank'>Buat Janji</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-9 mx-auto">
                        <div class="container py-4">
                            <div class="dokter-header mb-0">
                                <h5 class="fw-bold mb-1">${dokter.paramedicName}</h5>
                                <span class="speciality-badge">
                                    <p class="speciality-title">Spesialis Jantung</p>
                                </span>
                            </div>
                            <div class="jadwal-wrapper">
                                <h2 class="jadwal-title">
                                    <i class="fa-regular fa-calendar"></i>
                                    Jadwal Dokter
                                </h2>
                                <div class="jadwal-scroll">
                                    <div class="jadwal-grid" id="jadwalGrid-${dokter.paramedicCode}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
}

export function renderDoctorPage(onPageChange) {
    const container = document.getElementById("daftar-dokter");

    if (state.filteredDoctorList.length === 0) {
        container.innerHTML = `
            <div class="container bg-light text-muted rounded shadow-sm text-center py-3 my-3">
                <h5>Mohon Maaf Saat Ini Data Dokter Tersebut Belum Tersedia...</h5>
            </div>
        `;
        renderPagination(0, onPageChange);
        return;
    }

    const totalPages = Math.ceil(state.filteredDoctorList.length / state.itemsPerPage);
    if (state.currentPage > totalPages) state.currentPage = totalPages;
    if (state.currentPage < 1) state.currentPage = 1;

    const startIndex = (state.currentPage - 1) * state.itemsPerPage;
    const pageItems = state.filteredDoctorList.slice(startIndex, startIndex + state.itemsPerPage);

    container.innerHTML = pageItems.map(createDoctorCard).join("");

    pageItems.forEach((doctor) => {
        const grid = document.getElementById(`jadwalGrid-${doctor.paramedicCode}`);
        if (grid) {
            const { html, gridStyle } = createScheduleGrid(doctor);
            grid.innerHTML = html;
            grid.style.cssText = gridStyle;
        }
    });

    renderPagination(totalPages, onPageChange);
}

export function renderPagination(totalPages, onPageChange) {
    let paginationContainer = document.getElementById("doctorPagination");

    if (!paginationContainer) {
        paginationContainer = document.createElement("nav");
        paginationContainer.id = "doctorPagination";
        document.getElementById("daftar-dokter").insertAdjacentElement("afterend", paginationContainer);
    }

    if (totalPages <= 1) {
        paginationContainer.innerHTML = "";
        return;
    }

    let pagesHtml = "";
    for (let i = 1; i <= totalPages; i++) {
        pagesHtml += `
            <li class="page-item ${i === state.currentPage ? "active" : ""}">
                <button class="page-link" data-page="${i}">${i}</button>
            </li>
        `;
    }

    paginationContainer.innerHTML = `
        <ul class="pagination justify-content-center mt-3">
            <li class="page-item ${state.currentPage === 1 ? "disabled" : ""}">
                <button class="page-link" data-page="${state.currentPage - 1}">&laquo;</button>
            </li>
            ${pagesHtml}
            <li class="page-item ${state.currentPage === totalPages ? "disabled" : ""}">
                <button class="page-link" data-page="${state.currentPage + 1}">&raquo;</button>
            </li>
        </ul>
    `;

    paginationContainer.querySelectorAll(".page-link").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            const targetPage = parseInt(e.target.dataset.page);
            if (!targetPage || targetPage < 1 || targetPage > totalPages) return;
            onPageChange(targetPage);
        });
    });
}

export function showLoading() {
    const container = document.getElementById("daftar-dokter");
    if (container) {
        container.innerHTML = `
            <div class="container text-center py-5">
                <div class="spinner-border text-primary" role="status"></div>
                <p class="mt-2 text-muted">Memuat data dokter...</p>
            </div>
        `;
    }
    const pagination = document.getElementById("doctorPagination");
    if (pagination) pagination.innerHTML = "";
}

export function showError() {
    const container = document.getElementById("daftar-dokter");
    if (container) {
        container.innerHTML = `
            <div class="container bg-info text-muted rounded shadow-sm text-center py-3 my-5">
                <h4>Data dokter belum tersedia...</h4>
            </div>
        `;
    }
    const pagination = document.getElementById("doctorPagination");
    if (pagination) pagination.innerHTML = "";
}

export function renderModal(doctorData) {
    const hari = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];
    const fotoDokter = document.getElementById("foto-dokter");

    if (fotoDokter) {
        fotoDokter.innerHTML = `
            <img src="https://mobile.rs-elisabeth.com/paramedic/${doctorData.paramedicCode}.png" 
            alt="Doctor"
            onerror="this.onerror=null; this.src='/images/default.png';">
        `;
    }

    const namaDokter = document.getElementById("namaDokter");
    if (namaDokter) {
        namaDokter.textContent = doctorData.paramedicName;
    }

    let scheduleCard = "";
    for (const [day, detail] of Object.entries(doctorData.schedule)) {
        let scheduleTime = "";
        if (detail.length > 0) {
            detail.forEach((data) => {
                data['jam'].forEach((jam) => {
                    scheduleTime += `
                        <div class="jam col-12">
                            <p class="schedule-jam">${jam}</p>
                            <p class="schedule-unit">${data["serviceUnitName"]}</p>
                        </div>
                    `;
                });
            });
        } else {
            scheduleTime += `
                <div class="jam day-off col-12">
                    <p class="schedule-jam">-</p>
                    <p class="schedule-unit">-</p>
                </div>
            `;
        }
        
        scheduleCard += `
            <div class="col-12 col-lg-3 gap-2 mt-3">
                <div class="modal-schedule-card">
                    <div class="day-badge">
                        <p class="day-name">${hari[day - 1]}</p>
                    </div>
                    <div class="time-list row g-2">
                        ${scheduleTime}
                    </div>
                </div>
            </div>
        `;
    }

    const modalCards = document.getElementById("modal-schedule-cards");
    if (modalCards) {
        modalCards.innerHTML = scheduleCard;
    }
}
