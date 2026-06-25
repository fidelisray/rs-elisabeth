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

            const days = [
                "Senin",
                "Selasa",
                "Rabu",
                "Kamis",
                "Jumat",
                "Sabtu",
                "Minggu",
            ];

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

            console.log(doctor_list);

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

export function initDokter() {
    document.getElementById("daftar-dokter").innerHTML =
        "<p>Pilih Klinik...</p>";

    fetch(`/dokter/init`)
        .then((response) => response.json())
        .then((doctors) => {
            // console.log(doctors);
            const container = document.getElementById("default-card");

            if (container.classList.contains("d-none")) {
                container.classList.remove("d-none");
            }

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

            console.log("initDokter => ");

            console.log(dataDokter);

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
        })
        .catch((error) => {
            document.getElementById("daftar-dokter").innerHTML =
                "<p>Gagal mengambil data. Silakan coba lagi.</p>";
            console.error("Error:", error);
        });

    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("clinic-option")) {
            const unitId = event.target.getAttribute("data-code");
            // getDokterByUnit(unitId);
            getDokterBySpecialtyCode(unitId);
        }
    });
}

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
