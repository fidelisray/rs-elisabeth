// ============================================
// STATE GLOBAL
// ============================================

const ITEMS_PER_PAGE = 8;

let FULL_DOCTOR_LIST = []; // hasil preprocessing, tidak berubah
let FILTERED_DOCTOR_LIST = []; // hasil filter search, yang dipakai render
let CURRENT_PAGE = 1;

function randomString() {
    const chars = "0123456789abcdef";
    let result = "";

    for (let i = 0; i < 16; i++) {
        result += chars[Math.floor(Math.random() * chars.length)];
    }

    return result;
}

// fetch data dokter
const klinikType = ["", "Eksekutif"];

function getDokterByUnit(unitId) {
    document.getElementById("daftar-dokter").innerHTML = "<p>Loading...</p>";

    fetch(`/dokter/${unitId}`)
        .then((response) => response.json())
        .then((doctors) => {
            // console.log(doctors);
            const container = document.getElementById("daftar-dokter");

            if (doctors.length === 0) {
                container.innerHTML = "<p>Tidak ada dokter di unit ini.</p>";
                return;
            }

            let dataDokter = doctors.map((doctor) => ({
                nama: doctor.ParamedicName,
                nip: doctor.ParamedicCode,
                unitCode: doctor.ServiceUnitCode,
                unitName: doctor.ServiceUnitName,
                jadwal: doctor.Schedules.map((schedule) => ({
                    hari: schedule.Day,
                    jam: schedule.OperationalTimeName.split("|"),
                })),
            }));

            // console.log(dataDokter);

            const html = dataDokter
                .map(
                    (dokter) => `
                <div class="card shadow-sm border-0 mb-3">

                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Kolom Foto + Informasi Dokter -->
                        <div class="col-12 col-md-3 border-end">
                            <div class="p-4 text-center">
                                <img
                                    src="https://mobile.rs-elisabeth.com/paramedic/${dokter.nip}.png"
                                    class="rounded-circle img-fluid mb-3"
                                    style="width:120px;height:120px;object-fit:cover;"
                                    alt="Foto Dokter">
                                <h5 class="fw-bold mb-1">${dokter.nama}</h5>
                                <span class="badge bg-primary mb-3 d-none">
                                    Spesialis Jantung
                                </span>
                            </div>
                        </div>
                        <!-- Kolom Jadwal -->
                        <div class="col-12 col-md-6 mx-auto">
                            <label class="form-label fw-semibold">
                                Jadwal Dokter
                            </label>
                            <div class="col align-items-center">
    
                                <div class="row">
    
                                ${dokter.jadwal
                                    .map(
                                        (jadwal) =>
                                            `
                                            <div class="col-12 col-md-4 g-3">
                                                <div class="schedule shadow-sm h-100">
                                                    <h5 class="schedule-title">${jadwal.hari}</h5>
                                                    <p class="unit-name">${dokter.unitName.toLowerCase()} ${klinikType[Math.floor(Math.random() * klinikType.length)]}</p>
                                                    <div class="d-flex flex-column">
                                                        ${jadwal.jam
                                                            .map(
                                                                (time) =>
                                                                    `<small class="schedule-time">${time}</small>`,
                                                            )
                                                            .join("")}
                                                    </div>
                                                </div>
                                            </div>
                                            `,
                                    )
                                    .join("")}
                                </div>
                            </div>
                        </div>
                        <!-- Tombol -->
                        <div class="col-12 col-md-2 mx-4">
                            <div class="d-grid gap-2">
                                <a 
                                    href='#' 
                                    class='btn btn-outline-primary'
                                    data-bs-toggle='modal'
                                    data-bs-target='#detailDokter'

                                    data-nama='${dokter.nama}'
                                    data-id='${dokter.nip}'
                                    data-jadwal='${JSON.stringify(dokter.jadwal)}'>Cek Profil</a>
                                <a href="https://regonline.rs-elisabeth.com/" class="btn btn-success" target="_blank">Buat Janji</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `,
                )
                .join("");

            container.innerHTML = html;
            if (
                !document
                    .getElementById("default-card")
                    .classList.contains("d-none")
            ) {
                document.getElementById("default-card").classList.add("d-none");
            }
        })
        .catch((error) => {
            document.getElementById("daftar-dokter").innerHTML =
                "<p>Gagal mengambil data. Silakan coba lagi.</p>";
            console.error("Error:", error);
        });
}

const DAYS = [1, 2, 3, 4, 5, 6, 7];

function normalizeSchedule(jadwal) {
    const result = {};

    DAYS.forEach((day) => {
        result[day] = [];
    });

    jadwal.forEach((item) => {
        result[item.hari] = item.detail;
    });

    return result;
}

function preprocessingApiData(doctor) {
    // const DAYS = [
    //     "senin",
    //     "selasa",
    //     "rabu",
    //     "kamis",
    //     "jumat",
    //     "sabtu"
    // ];

    const doctorMap = new Map();

    doctor.forEach((item) => {
        if (!doctorMap.has(item.ParamedicCode)) {
            const schedule = {};

            DAYS.forEach((day) => {
                schedule[day] = [];
            });

            doctorMap.set(item.ParamedicCode, {
                entry_id: `${item.ServiceUnitCode}0823${item.ParamedicCode}9373`,
                paramedic_code: item.ParamedicCode,
                paramedic_name: item.ParamedicName,
                schedule,
                // schedule: new Map(),
            });
        }

        const doc = doctorMap.get(item.ParamedicCode);

        doc.schedule[item.DayNumber].push({
            jam: item.OperationalTimeName.split("|"),
            serviceUnitCode: item.ServiceUnitCode,
            serviceUnitName: item.ServiceUnitName,
        });

        /*
        if (!doc.schedule.has(item.DayNumber)) {
            doc.schedule.set(item.DayNumber, {
                hari: item.DayNumber,
                detail: [],
            });
        }

        doc.schedule.get(item.DayNumber).detail.push({
            jam: item.OperationalTimeName,
            serviceUnitCode: item.ServiceUnitCode,
            serviceUnitName: item.ServiceUnitName,
        });
        */
    });

    // const result = [...doctorMap.values()].map((doc) => ({
    //     ...doc,
    //     schedule: [...doc.schedule.values()],
    // }));
    const result = [...doctorMap.values()];

    /* =========================================
    const doctorMap = new Map();

    doctor.forEach((item) => {
        if (!doctorMap.has(item.id)) {
            const jadwal = {};

            DAYS.forEach((day) => {
                jadwal[day] = [];
            });

            doctorMap.set(item.id, {
                id: item.id,
                name: item.name,
                jadwal,
            });
        }

        const emp = doctorMap.get(item.id);

        emp.jadwal[item.hari].push({
            jam: item.jam,
            serviceUnit: item.serviceUnit,
        });
    });

    const result = [...doctorMap.values()];
    =========================================== */
    // console.log("Inside Function preprocessingApiData ------> ");
    // console.log(doctor);
    // console.log(result);

    return result;
}

/* Tampilan Layout Versi Semua Hari ikut di render */
// function getMaxSlot(schedule) {
//     return Math.max(...Object.values(schedule).map((day) => day.length));
// }

/*
function renderHeader(grid) {
    const today = new Date().getDay();

    const hariIndonesia = {
        1: "Senin",
        2: "Selasa",
        3: "Rabu",
        4: "Kamis",
        5: "Jumat",
        6: "Sabtu",
        7: "Minggu",
    };

    DAYS.forEach((day) => {
        const header = document.createElement("div");
        header.classList.add("day-header");

        if (day === today) {
            header.classList.add("today");
        }

        header.textContent = hariIndonesia[day];

        grid.appendChild(header);
    });
}
*/


function renderHeader(grid, schedule) {
    const hariIndonesia = {
        1: "Senin",
        2: "Selasa",
        3: "Rabu",
        4: "Kamis",
        5: "Jumat",
        6: "Sabtu",
        7: "Minggu",
    };

    const activeDays = DAYS.filter((day) => schedule[day].length > 0);

    activeDays.forEach((day) => {
        const header = document.createElement("div");

        header.classList.add("day-header");

        header.textContent = hariIndonesia[day];

        grid.appendChild(header);
    });
}


/*
function createScheduleCard(jam, serviceUnitName, day) {
    const card = document.createElement("div");
    card.classList.add("schedule-card");

    const today = new Date().getDay();

    if (day === today) {
        card.classList.add("today-card");
    }

    // item.jam.forEach((jam) => {

    // });
    card.innerHTML = `
        <span class="sc-time">${jam}</span>
        <span class="sc-klinik">${serviceUnitName}</span>
    `;

    return card;
}
*/

function createScheduleCard(jam, serviceUnitName) {
    const card = document.createElement("div");

    card.classList.add("schedule-card");

    card.innerHTML = `
        <span class="sc-time">
            ${jam}
        </span>
        <span class="sc-klinik">
            ${serviceUnitName}
        </span>
    `;

    return card;
}

function getDayCardCount(daySchedule) {
    return daySchedule.reduce((total, item) => total + item.jam.length, 0);
}

function getMaxSlot(schedule) {
    return Math.max(...Object.values(schedule).map(getDayCardCount));
}


function createEmptyCard() {
    const card = document.createElement("div");
    card.classList.add("schedule-card", "empty-card");

    return card;
}

/*
function renderSchedule(dokter) {
    const grid = document.getElementById(`jadwalGrid-${dokter.paramedic_code}`);

    grid.innerHTML = "";

    renderHeader(grid);

    // const schedule = normalizeSchedule(dokter.schedule);
    const schedule = dokter.schedule;

    const maxSlot = getMaxSlot(schedule);

    DAYS.forEach((day) => {
        const col = document.createElement("div");
        col.classList.add("slot-col");

        schedule[day].forEach((item) => {
            item.jam.forEach((jam) => {
                col.appendChild(
                    createScheduleCard(jam, item.serviceUnitName, day),
                );
            });
        });

        const emptyCount = maxSlot - schedule[day].length;

        for (let i = 0; i < emptyCount; i++) {
            col.appendChild(createEmptyCard());
        }

        grid.appendChild(col);
    });
}
*/


function renderSchedule(dokter) {
    const grid = document.getElementById(`jadwalGrid-${dokter.paramedic_code}`);

    grid.innerHTML = "";

    const schedule = dokter.schedule;

    const maxSlot = getMaxSlot(schedule);

    // const activeDays = DAYS.filter((day) => schedule[day].length > 0);

    // grid.style.gridTemplateColumns = `repeat(${activeDays.length}, minmax(120px, 1fr))`;

    // grid.style.minWidth = `${activeDays.length * 130}px`;

    const activeDays = DAYS.filter((day) => schedule[day].length > 0);

    grid.style.gridTemplateColumns = `repeat(${activeDays.length}, minmax(120px, 1fr))`;

    grid.style.minWidth = `${Math.max(activeDays.length, 4) * 130}px`;

    renderHeader(grid, schedule);

    activeDays.forEach((day) => {
        const col = document.createElement("div");

        col.classList.add("slot-col");

        schedule[day].forEach((item) => {
            item.jam.forEach((jam) => {
                col.appendChild(createScheduleCard(jam, item.serviceUnitName));
            });
        });

        const emptyCount = maxSlot - getDayCardCount(schedule[day]);

        for (let i = 0; i < emptyCount; i++) {
            col.appendChild(createEmptyCard());
        }

        grid.appendChild(col);
    });
}




function getDoctorCard(doctor_list) {
    const html = doctor_list
        .map(
            (dokter) => `
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Kolom Foto + Informasi Dokter -->
                        <div class="col-12 col-md-3 border-end">
                            <div class="p-4 text-center">
                                <img
                                    src="https://mobile.rs-elisabeth.com/paramedic/${dokter.nip}.png"
                                    class="rounded-circle img-fluid mb-3"
                                    style="width:120px;height:120px;object-fit:cover;"
                                    alt="Foto Dokter">
                                <h5 class="fw-bold mb-1">${dokter.nama}</h5>
                                <span class="badge bg-primary mb-3 d-none">
                                    Spesialis Jantung
                                </span>
                            </div>
                        </div>
                        <!-- Kolom Jadwal -->
                        <div class="col-12 col-md-6 mx-auto">
                            <label class="form-label fw-semibold">
                                Jadwal Dokter
                            </label>

                            <div class="row g-3">
                            ${dokter.jadwal
                                .map(
                                    (jadwal) =>
                                        `
                                        <div class="col-12 col-md-4">
                                            <div class="schedule h-100 border shadow-sm">
                                                <div class="schedule-body h-100 w-100">
                                                    <h5 class="schedule-title">
                                                        <i class="fa-solid fa-calendar-day me-1 text-muted"></i>
                                                        ${jadwal.hari}
                                                    </h5>
                                                    <div class="d-flex flex-column gap-2">
                                                    
                                                    ${jadwal.detail
                                                        .map(
                                                            (detail) =>
                                                                `
                                                                <div>
                                                                    <div class="schedule-detail shadow-sm">
                                                                        <p class="schedule-time">
                                                                            <i class="fa-solid fa-clock"></i>
                                                                            ${detail.jam}
                                                                        </p>
                                                                        <div class="unit-name-bg">
                                                                            <p class="unit-name">${detail.serviceUnitName.toLowerCase()}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                `,
                                                        )
                                                        .join("")}
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                
                                        `,
                                )
                                .join(" ")}

                            </div>
                        </div>
                        <!-- Tombol -->
                        <div class="col-12 col-md-2 mx-4">
                            <div class="d-grid gap-2">
                                <a 
                                    href='#' 
                                    class='btn btn-outline-primary'
                                    data-bs-toggle='modal'
                                    data-bs-target='#detailDokter'

                                    data-nama='${dokter.nama}'
                                    data-id='${dokter.nip}'
                                    data-jadwal='${JSON.stringify(dokter.jadwal)}'>Cek Profil</a>
                                <a href="https://regonline.rs-elisabeth.com/" class="btn btn-success" target="_blank">Buat Janji</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    `,
        )
        .join("");

    return html;
}

// function getDokter(specialtyCode) {
//     fetch(`/dokter/${specialtyCode}`)
//         .then((response) => response.json())
//         .then((data) => {
//             // const dummy_layout = document.getElementById("coba-layout-baru");

//             const { LeaveSchedule, ScheduleByDay, ScheduleRoutine } = data;

//             const doctor_list = preprocessingApiData(ScheduleRoutine);
//             console.log("Function Get Dokter");

//             /*
//             console.log(doctor_list);

//             const html = doctor_list
//                 .map(
//                     (dokter) => `
//                         <div class="card shadow-sm border-0 mb-3">
//                             <div class="card-body">
//                                 <div class="row align-items-center">
//                                     <!-- Kolom Foto + Informasi Dokter -->
//                                     <div class="col-12 col-md-3 border-end">
//                                         <div class="p-4 text-center">
//                                             <img
//                                                     src="https://mobile.rs-elisabeth.com/paramedic/${dokter.paramedic_code}.png"
//                                                     class="rounded-circle img-fluid mb-3"
//                                                     style="width:120px;height:120px;object-fit:cover;"
//                                                     alt="Foto Dokter">
//                                             <h5 class="fw-bold mb-1">${dokter.paramedic_name}</h5>
//                                             <span class="badge bg-primary mb-3 d-none">
//                                                     Spesialis Jantung
//                                             </span>
//                                         </div>
//                                     </div>
//                                     <!-- Kolom Jadwal -->
//                                     <div class="col-12 col-md-9 mx-auto">
//                                         <div class="container py-4">
//                                             <div class="jadwal-wrapper">
//                                                 <h2 class="jadwal-title">Jadwal Dokter</h2>

//                                                 <div class="jadwal-scroll">
//                                                     <div class="jadwal-grid" id="jadwalGrid-${dokter.paramedic_code}">

//                                                     </div>
//                                                 </div>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     `,
//                 )
//                 .join("");

//             dummy_layout.innerHTML = html;
//             doctor_list.forEach((doctor) => {
//                 renderSchedule(doctor);
//             });
//             */

//             FILTERED_DOCTOR_LIST = doctor_list;
//             CURRENT_PAGE = 1;
//             renderDoctorPage();
//         })
//         .catch((error) => {
//             // document.getElementById("daftar-dokter").innerHTML =
//             //     "<p>Gagal mengambil data. Silakan coba lagi.</p>";
//             console.error("Error:", error);
//         });
// }

function getDokterBySpecialtyCode(specialtyCode) {
    fetch(`/dokter/${specialtyCode}`)
        .then((response) => response.json())
        .then((data) => {
            const container = document.getElementById("daftar-dokter");

            if (data.length === 0) {
                container.innerHTML = "<p>Tidak ada dokter di unit ini.</p>";
                return;
            }

            console.log(data);

            const days = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

            const { LeaveSchedule, ScheduleByDay, ScheduleRoutine } = data;

            // console.log(LeaveSchedule);
            // console.log(ScheduleRoutine);

            const map = new Map();

            // ScheduleRoutine.forEach((item) => {
            //     if (!map.has(item.ParamedicCode)) {
            //         map.set(item.ParamedicCode, {
            //             nip: item.ParamedicCode,
            //             nama: item.ParamedicName,
            //             unitCode: item.ServiceUnitCode,
            //             unitName: item.ServiceUnitName,
            //             jadwal: [],
            //         });
            //     }

            //     // map.get(item.ParamedicCode).jadwal.hari.push(
            //     //     days[item.DayNumber - 1],
            //     // );
            //     map.get(item.ParamedicCode).jadwal.push({
            //         hari: days[item.DayNumber - 1],
            //         jam: [],
            //     });
            //     map.get(item.ParamedicCode)
            //         .jadwal.get(hari)
            //         .jam.push(item.OperationalTimeName);
            // });

            ScheduleRoutine.forEach((item) => {
                if (!map.has(item.ParamedicCode)) {
                    map.set(item.ParamedicCode, {
                        nip: item.ParamedicCode,
                        nama: item.ParamedicName,
                        jadwal: [],
                    });
                }

                const currentDoctor = map.get(item.ParamedicCode);

                // Cari hari yang sudah ada
                let jadwalHari = currentDoctor.jadwal.find(
                    (jadwal) => jadwal.hari === days[item.DayNumber - 1],
                );

                // Jika hari belum ada
                if (!jadwalHari) {
                    jadwalHari = {
                        hari: days[item.DayNumber - 1],
                        detail: [],
                    };

                    currentDoctor.jadwal.push(jadwalHari);
                }

                // Tambahkan jam
                jadwalHari.detail.push({
                    jam: item.OperationalTimeName,
                    serviceUnitCode: item.ServiceUnitCode,
                    serviceUnitName: item.ServiceUnitName,
                });
            });

            const doctor_list = [...map.values()];

            console.log("getDokterBySpecialtyCode => ");

            // console.log(doctor_list);

            const html = getDoctorCard(doctor_list);

            container.innerHTML = html;
            if (
                !document
                    .getElementById("default-card")
                    .classList.contains("d-none")
            ) {
                document.getElementById("default-card").classList.add("d-none");
            }
        })
        .catch((error) => {
            document.getElementById("daftar-dokter").innerHTML =
                "<p>Gagal mengambil data. Silakan coba lagi.</p>";
            console.error("Error:", error);
        });
}

// ============================================
// INITIALIZE — fetch sekali saat halaman load
// ============================================
function setDoctorContext(doctor_list) {
    FULL_DOCTOR_LIST = doctor_list;
    FILTERED_DOCTOR_LIST = doctor_list;
    CURRENT_PAGE = 1;
    document.getElementById("searchKeyword").value = "";
    renderDoctorPage();
}

function getDokter(specialtyCode) {
    const container = document.getElementById("daftar-dokter");

    container.innerHTML = `
        <div class="container text-center">
            <div class="spinner-border text-primary" role="status"></div>
        </div>
    `;

    fetch(`/dokter/${specialtyCode}`)
        .then((response) => {
            if (!response.ok) throw new Error(`HTTP ${response.status}`);
            return response.json();
        })
        .then((data) => {
            const { ScheduleRoutine } = data;

            if (!ScheduleRoutine || ScheduleRoutine.length === 0) {
                FULL_DOCTOR_LIST = [];
                FILTERED_DOCTOR_LIST = [];
                CURRENT_PAGE = 1;
                renderDoctorPage();
                return;
            }

            const doctor_list = preprocessingApiData(ScheduleRoutine);
            console.log(doctor_list);

            setDoctorContext(doctor_list);
        })
        .catch((error) => {
            container.innerHTML = `
                <div class="container bg-info text-muted rounded shadow-sm text-center py-3 my-5">
                    <h4>Gagal mengambil data dokter.</h4>
                </div>`;
            console.error("Error:", error);
        });
}

export async function initializeDoctor() {
    const container = document.getElementById("daftar-dokter");

    container.innerHTML = `
        <div class="container text-center">
            <div class="spinner-border text-primary" role="status"></div>
        </div>
    `;

    try {
        // const response = await fetch(`/dokter/all-dokter`);

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        const response = await fetch(`/dokter/all-dokter`, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": csrfToken,
            },
        });

        if (!response.ok)
            throw new Error(`${response.status}: Data tidak tersedia`);

        const data = await response.json();

        // console.log(data.slice(0, 2));
        // return;

        if (!data || data.length === 0) {
            container.innerHTML = `<p>Tidak ada dokter yang tersedia</p>`;
            return;
        }

        const doctor_list = preprocessingApiData(data);
        console.log(doctor_list);

        // console.log(doctor_list);
        // return;

        // Simpan ke state global, bukan langsung render
        setDoctorContext(doctor_list);
    } catch (error) {
        container.innerHTML = `
            <div class="container bg-info text-muted rounded shadow-sm text-center py-3 my-5">
                <h4>Data dokter belum tersedia...</h4>
            </div>`;
        console.log("Error", error);
    }
}

// ============================================
// RENDER HALAMAN — dipanggil ulang setiap ganti page / search
// ============================================
function renderDoctorPage() {
    const container = document.getElementById("daftar-dokter");

    if (FILTERED_DOCTOR_LIST.length === 0) {
        container.innerHTML = `
            <div class="container bg-light text-muted rounded shadow-sm text-center py-3 my-3">
                <h5>Mohon Maaf Saat Ini Data Dokter Tersebut Belum Tersedia...</h5>
            </div>
        `;
        renderPagination(); // kosongkan pagination juga
        return;
    }

    const totalPages = Math.ceil(FILTERED_DOCTOR_LIST.length / ITEMS_PER_PAGE);

    // Guard jika CURRENT_PAGE keluar batas (misal habis search lalu data berkurang)
    if (CURRENT_PAGE > totalPages) CURRENT_PAGE = totalPages;
    if (CURRENT_PAGE < 1) CURRENT_PAGE = 1;

    const startIndex = (CURRENT_PAGE - 1) * ITEMS_PER_PAGE;
    const pageItems = FILTERED_DOCTOR_LIST.slice(
        startIndex,
        startIndex + ITEMS_PER_PAGE,
    );

    const html = pageItems
        .map(
            (dokter) => `
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-3 border-end">
                                <div class="p-4 text-center">
                                    <img
                                        src="https://mobile.rs-elisabeth.com/paramedic/${dokter.paramedic_code}.png"
                                        class="rounded-circle img-fluid mb-3"
                                        style="width:180px;height:180px;object-fit:cover;"
                                        alt="Foto Dokter">
                                    <!-- <h5 class="fw-bold mb-1">${dokter.paramedic_name}</h5> -->
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
                                        <h5 class="fw-bold mb-1">${dokter.paramedic_name}</h5>
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
                                            <div class="jadwal-grid" id="jadwalGrid-${dokter.paramedic_code}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `,
        )
        .join("");

    container.innerHTML = html;

    pageItems.forEach((doctor) => {
        renderSchedule(doctor);
    });

    renderPagination(totalPages);
}

// ============================================
// RENDER PAGINATION
// ============================================
function renderPagination(totalPages = 0) {
    let paginationContainer = document.getElementById("doctorPagination");

    // Buat container pagination jika belum ada di DOM
    if (!paginationContainer) {
        paginationContainer = document.createElement("nav");
        paginationContainer.id = "doctorPagination";
        document
            .getElementById("daftar-dokter")
            .insertAdjacentElement("afterend", paginationContainer);
    }

    if (totalPages <= 1) {
        paginationContainer.innerHTML = "";
        return;
    }

    let pagesHtml = "";

    for (let i = 1; i <= totalPages; i++) {
        pagesHtml += `
            <li class="page-item ${i === CURRENT_PAGE ? "active" : ""}">
                <button class="page-link" data-page="${i}">${i}</button>
            </li>
        `;
    }

    paginationContainer.innerHTML = `
        <ul class="pagination justify-content-center mt-3">
            <li class="page-item ${CURRENT_PAGE === 1 ? "disabled" : ""}">
                <button class="page-link" data-page="${CURRENT_PAGE - 1}">&laquo;</button>
            </li>
            ${pagesHtml}
            <li class="page-item ${CURRENT_PAGE === totalPages ? "disabled" : ""}">
                <button class="page-link" data-page="${CURRENT_PAGE + 1}">&raquo;</button>
            </li>
        </ul>
    `;

    // Event delegation untuk tombol pagination
    paginationContainer.querySelectorAll(".page-link").forEach((btn) => {
        btn.addEventListener("click", (e) => {
            const targetPage = parseInt(e.target.dataset.page);

            if (!targetPage || targetPage < 1) return;

            CURRENT_PAGE = targetPage;
            renderDoctorPage();

            // Scroll ke atas list agar user tidak bingung posisi
            document
                .getElementById("daftar-dokter")
                .scrollIntoView({ behavior: "smooth", block: "start" });
        });
    });
}

// ============================================
// SEARCH — keyup dengan debounce
// ============================================
const searchInput = document.getElementById("searchKeyword");
let searchDebounceTimer;

searchInput.addEventListener("keyup", function () {
    clearTimeout(searchDebounceTimer);

    searchDebounceTimer = setTimeout(() => {
        const keyword = this.value.trim().toLowerCase();

        if (keyword === "") {
            FILTERED_DOCTOR_LIST = FULL_DOCTOR_LIST;
        } else {
            FILTERED_DOCTOR_LIST = FULL_DOCTOR_LIST.filter((dokter) => {
                const nama = dokter.paramedic_name?.toLowerCase() || "";
                // Tambahkan field lain jika ada, misal nama klinik/spesialis
                return nama.includes(keyword);
            });
        }

        CURRENT_PAGE = 1; // reset ke halaman pertama tiap kali search berubah
        renderDoctorPage();
    }, 400); // debounce 400ms, mencegah render tiap ketikan huruf
});

/*
async function initializeDoctor() {
    const container = document.getElementById("daftar-dokter");

    container.innerHTML = `
        <div class="container text-center">
            <div class="spinner-border text-primary" role="status"></div>
        </div>
    `;

    try {
        const response = await fetch(`/dokter/all-dokter`);

        // if (!response.ok) throw new Error(`HTTP ${response.status}`);
        if (!response.ok) throw new Error(`${response.status}: Data tidak tersedia`);

        const data = await response.json();

        if (!data || data.length === 0) {
            container.innerHTML = `
                <p>Tidak ada dokter yang tersedia</p>
            `;
            return;
        }

        const doctor_list = preprocessingApiData(data.slice(0, 30));
        console.log(doctor_list.slice(0, 2));

        const html = doctor_list
            .map(
                (dokter) => `
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Kolom Foto + Informasi Dokter -->
                                <div class="col-12 col-md-3 border-end">
                                    <div class="p-4 text-center">
                                        <img
                                                src="https://mobile.rs-elisabeth.com/paramedic/${dokter.paramedic_code}.png"
                                                class="rounded-circle img-fluid mb-3"
                                                style="width:120px;height:120px;object-fit:cover;"
                                                alt="Foto Dokter">
                                        <h5 class="fw-bold mb-1">${dokter.paramedic_name}</h5>
                                        <span class="badge bg-primary mb-3 d-none">
                                                Spesialis Jantung
                                        </span>
                                    </div>
                                </div>
                                <!-- Kolom Jadwal -->
                                <div class="col-12 col-md-9 mx-auto">
                                    <div class="container py-4">
                                        <div class="jadwal-wrapper">
                                            <h2 class="jadwal-title">Jadwal Dokter</h2>

                                            <div class="jadwal-scroll">
                                                <div class="jadwal-grid" id="jadwalGrid-${dokter.paramedic_code}">


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `,
            )
            .join("");

        // if (
        //     !document
        //         .getElementById("default-card")
        //         .classList.contains("d-none")
        // ) {
        //     document.getElementById("default-card").classList.add("d-none");
        // }

        container.innerHTML = html;
        doctor_list.forEach((doctor) => {
            renderSchedule(doctor);
        });
    } catch (error) {
        container.innerHTML =
            // "<p>Gagal Mengambil data. Silahkan Coba Lagi..</p>";
            `<div class="container bg-info text-muted rounded shadow-sm text-center py-3 my-5">
                <h4>Data dokter belum tersedia...</h4>
            </div>`;

        console.log("Error", error);
    }
}
*/

export function initDokter() {
    // document.getElementById("daftar-dokter").innerHTML =
    //     "<p>Pilih Klinik...</p>";

    // fetch(`/dokter/init`)
    //     .then((response) => response.json())
    //     .then((doctors) => {
    //         // console.log(doctors);
    //         const container = document.getElementById("default-card");

    //         if (container.classList.contains("d-none")) {
    //             container.classList.remove("d-none");
    //         }

    //         if (doctors.length === 0) {
    //             container.innerHTML = "<p>Tidak ada dokter di unit ini.</p>";
    //             return;
    //         }

    //         let dataDokter = doctors.map((doctor) => ({
    //             nama: doctor.ParamedicName,
    //             nip: doctor.ParamedicCode,
    //             unitCode: doctor.ServiceUnitCode,
    //             unitName: doctor.ServiceUnitName,
    //             jadwal: doctor.Schedules.map((schedule) => ({
    //                 hari: schedule.Day,
    //                 jam: schedule.OperationalTimeName.split("|"),
    //             })),
    //         }));

    //         console.log("initDokter => ");

    //         console.log(dataDokter);

    //         const html = dataDokter
    //             .map(
    //                 (dokter) => `
    //             <div class="card shadow-sm border-0 mb-3">

    //             <div class="card-body">
    //                 <div class="row align-items-center">
    //                     <!-- Kolom Foto + Informasi Dokter -->
    //                     <div class="col-12 col-md-3 border-end">
    //                         <div class="p-4 text-center">
    //                             <img
    //                                 src="https://mobile.rs-elisabeth.com/paramedic/${dokter.nip}.png"
    //                                 class="rounded-circle img-fluid mb-3"
    //                                 style="width:120px;height:120px;object-fit:cover;"
    //                                 alt="Foto Dokter">
    //                             <h5 class="fw-bold mb-1">${dokter.nama}</h5>
    //                             <span class="badge bg-primary mb-3 d-none">
    //                                 Spesialis Jantung
    //                             </span>
    //                         </div>
    //                     </div>
    //                     <!-- Kolom Jadwal -->
    //                     <div class="col-12 col-md-6 mx-auto">
    //                         <label class="form-label fw-semibold">
    //                             Jadwal Dokter
    //                         </label>
    //                         <div class="col align-items-center">

    //                             <div class="row">

    //                             ${dokter.jadwal
    //                                 .map(
    //                                     (jadwal) =>
    //                                         `
    //                                         <div class="col-12 col-md-4 g-3">
    //                                             <div class="schedule shadow-sm h-100">
    //                                                 <h5 class="schedule-title">${jadwal.hari}</h5>
    //                                                 <p class="unit-name">${dokter.unitName.toLowerCase()} ${klinikType[Math.floor(Math.random() * klinikType.length)]}</p>
    //                                                 <div class="d-flex flex-column">
    //                                                     ${jadwal.jam
    //                                                         .map(
    //                                                             (time) =>
    //                                                                 `<small class="schedule-time">${time}</small>`,
    //                                                         )
    //                                                         .join("")}
    //                                                 </div>
    //                                             </div>
    //                                         </div>
    //                                         `,
    //                                 )
    //                                 .join("")}
    //                             </div>
    //                         </div>
    //                     </div>
    //                     <!-- Tombol -->
    //                     <div class="col-12 col-md-2 mx-4">
    //                         <div class="d-grid gap-2">
    //                             <a
    //                                 href='#'
    //                                 class='btn btn-outline-primary'
    //                                 data-bs-toggle='modal'
    //                                 data-bs-target='#detailDokter'

    //                                 data-nama='${dokter.nama}'
    //                                 data-id='${dokter.nip}'
    //                                 data-jadwal='${JSON.stringify(dokter.jadwal)}'>Cek Profil</a>
    //                             <a href="https://regonline.rs-elisabeth.com/" class="btn btn-success" target="_blank">Buat Janji</a>
    //                         </div>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>
    //         `,
    //             )
    //             .join("");

    //         container.innerHTML = html;
    //     })
    //     .catch((error) => {
    //         document.getElementById("daftar-dokter").innerHTML =
    //             "<p>Gagal mengambil data. Silakan coba lagi.</p>";
    //         console.error("Error:", error);
    //     });

    initializeDoctor();

    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("clinic-option")) {
            const unitId = event.target.getAttribute("data-code");
            // getDokterByUnit(unitId);
            // getDokterBySpecialtyCode(unitId);
            getDokter(unitId);
        }
    });
}

// ====================================================
// ====================Modal Dokter====================
// ====================================================
const detailDokter = document.getElementById("detailDokter");
// console.log(detailDokter);

detailDokter.addEventListener("show.bs.modal", (event) => {
    const hari = [
        "senin",
        "selasa",
        "rabu",
        "kamis",
        "jumat",
        "sabtu",
        "minggu",
    ];
    const button = event.relatedTarget;

    // const namaDokter = button.dataset.nama;
    // const jadwalDokter = JSON.parse(button.dataset.jadwal);
    const fotoDokter = document.getElementById("foto-dokter");

    const id = button.dataset.id;

    // console.log(id);
    // console.log(FILTERED_DOCTOR_LIST.find(item => item.entry_id === id));
    // return;

    const doctor = FILTERED_DOCTOR_LIST.find((item) => item.entry_id === id);

    const jadwalDokter = doctor.schedule;

    console.log(doctor);
    console.log(typeof doctor);

    // for (const day in jadwalDokter) {
    //     console.log(day);
    //     console.log(jadwalDokter[day]);

    // }

    fotoDokter.innerHTML = `
        <img src="https://mobile.rs-elisabeth.com/paramedic/${doctor.paramedic_code}.png" alt="Doctor">
    `;

    document.getElementById("namaDokter").textContent = doctor.paramedic_name;

    let scheduleCard = "";

    for (const [day, detail] of Object.entries(jadwalDokter)) {
        
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
                        <p class="day-name">
                            ${hari[day - 1]}
                        </p>
                    </div>
                    <div class="time-list row g-2">
                        ${scheduleTime}
                    </div>
                </div>
            </div>
        `;
    }

    // jadwalDokter.forEach((jadwal) => {
    //     console.log(jadwal);

    // let scheduleTime = "";
    // jadwal.jam.map((waktu) => {
    //     scheduleTime += `
    //         <span class="schedule-time">${waktu}</span>
    //     `;
    // });
    // scheduleCard += `
    //     <div class="col-12 col-lg-4">
    //         <div class="schedule-card">
    //             <div class="day-badge">${jadwal.hari}</div>

    //             <div>
    //                 <div class="schedule-day">${jadwal.hari}</div>
    //                 ${scheduleTime}
    //             </div>
    //         </div>
    //     </div>
    // `;
    // });

    document.getElementById("modal-schedule-cards").innerHTML = scheduleCard;
});

// Jalankan setelah DOM siap
document.addEventListener("DOMContentLoaded", initDokter);

// const employee = [
//     { id: "01", name: "pico", hari: "senin", jam: "08:00 - 09:00", serviceUnit: "regular" },
//     { id: "01", name: "pico", hari: "senin", jam: "12:00 - 13:00", serviceUnit: "specialist" },
//     { id: "02", name: "sparky", hari: "senin", jam: "08:00 - 09:00", serviceUnit: "specialist" },
//     { id: "02", name: "sparky", hari: "senin", jam: "10:00 - 12:00", serviceUnit: "regular" },
//     { id: "01", name: "pico", hari: "selasa", jam: "08:00 - 09:00", serviceUnit: "executive" },
//     { id: "01", name: "pico", hari: "selasa", jam: "13:00 - 15:00", serviceUnit: "specialist" },
//     { id: "01", name: "pico", hari: "selasa", jam: "17:00 - 18:00", serviceUnit: "regular" },
// ];

// const employee = [
//     {
//         id: "01",
//         name: "pico",
//         jadwal: [
//             {
//                 hari: "senin",
//                 jam: ["08:00 - 09:00", "12:00 - 13:00"],
//             },
//             {
//                 hari: "selasa",
//                 jam: ["08:00 - 09:00", "13:00 - 15:00", "17:00 - 18:00"],
//             },
//         ],
//     },
//     {
//         id: "02",
//         name: "sparky",
//         jadwal: [
//             {
//                 hari: "senin",
//                 jam: ["08:00 - 09:00", "10:00 - 12:00"],
//             },
//         ],
//     },
// ];

// async function initializeDoctor() {
//     const container = document.getElementById("daftar-dokter");

//     container.innerHTML = `
//         <div class="container text-center">
//             <div class="spinner-border text-primary" role="status"></div>
//         </div>
//     `;

//     try {
//         const response = await fetch(`/dokter/all-dokter`);

//         if (!response.success)
//             throw new Error(`${response.status}: Data tidak tersedia`);

//         const data = await response.json();

//         // console.log(data.slice(0, 30));

//         if (!data || data.length === 0) {
//             container.innerHTML = `
//                 <p>Tidak ada dokter yang tersedia</p>
//             `;
//             return;
//         }

//         const doctor_list = preprocessingApiData(data);
//         /*
//             Outuput nya :
//             [{
//                 paramedic_code: 'doc-01',
//                 paramedic_name: 'Dr. Budi',
//                 schedule: {
//                     1: [
//                         {
//                             jam: ['07:00 - 09:00'],
//                             serviceUnitCode: 'UN-001',
//                             serviceUnitName: 'Klinik Anak',
//                         },
//                         {
//                             jam: ['09:30 - 10:30'],
//                             serviceUnitCode: 'UN-011',
//                             serviceUnitName: 'Klinik Bedah Anak',
//                         }
//                     ],
//                     2: [],
//                     3: [
//                         {
//                             jam: ['08:00 - 10:00'],
//                             serviceUnitCode: 'UN-001',
//                             serviceUnitName: 'Klinik Anak',
//                         }
//                     ],
//                     4: [],
//                     5: [],
//                     6: [
//                         {
//                             jam: ['07:00 - 08:00'],
//                             serviceUnitCode: 'UN-001',
//                             serviceUnitName: 'Klinik Anak',
//                         },
//                         {
//                             jam: ['09:00 - 13:00'],
//                             serviceUnitCode: 'UN-005',
//                             serviceUnitName: 'Rawat Jalan',
//                         }

//                     ]
//                 }
//             }]
//         */

//         // console.log(doctor_list);

//         const html = doctor_list
//             .map(
//                 (dokter) => `
//                     <div class="card shadow-sm border-0 mb-3">
//                         <div class="card-body">
//                             <div class="row align-items-center">
//                                 <!-- Kolom Foto + Informasi Dokter -->
//                                 <div class="col-12 col-md-3 border-end">
//                                     <div class="p-4 text-center">
//                                         <img
//                                                 src="image/paramedic/${dokter.paramedic_code}.png"
//                                                 class="rounded-circle img-fluid mb-3"
//                                                 style="width:120px;height:120px;object-fit:cover;"
//                                                 alt="Foto Dokter">
//                                         <h5 class="fw-bold mb-1">${dokter.paramedic_name}</h5>
//                                         <span class="badge bg-primary mb-3 d-none">
//                                                 Spesialis Jantung
//                                         </span>
//                                     </div>
//                                 </div>
//                                 <!-- Kolom Jadwal -->
//                                 <div class="col-12 col-md-9 mx-auto">
//                                     <div class="container py-4">
//                                         <div class="jadwal-wrapper">
//                                             <h2 class="jadwal-title">Jadwal Dokter</h2>

//                                             <div class="jadwal-scroll">
//                                                 <div class="jadwal-grid" id="jadwalGrid-${dokter.paramedic_code}">

//                                                 </div>
//                                             </div>
//                                         </div>
//                                     </div>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 `,
//             )
//             .join("");

//         container.innerHTML = html;
//         doctor_list.forEach((doctor) => {
//             renderSchedule(doctor);
//         });
//     } catch (error) {
//         container.innerHTML =
//             // "<p>Gagal Mengambil data. Silahkan Coba Lagi..</p>";
//             `<div class="container bg-info text-muted rounded shadow-sm text-center py-3 my-5">
//                 <h4>Data dokter belum tersedia...</h4>
//             </div>`;

//         console.log("Error", error);
//     }
// }

// function getDokter(specialtyCode) {
//     fetch(`/dokter/${specialtyCode}`)
//         .then((response) => response.json())
//         .then((data) => {

//             const { LeaveSchedule, ScheduleByDay, ScheduleRoutine } = data;

//             const doctor_list = preprocessingApiData(ScheduleRoutine);

//             FILTERED_DOCTOR_LIST = doctor_list;
//             CURRENT_PAGE = 1;
//             renderDoctorPage();
//         })
//         .catch((error) => {
//             console.error("Error:", error);
//         });
// }
