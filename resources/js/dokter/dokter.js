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
            if (!document.getElementById("default-card").classList.contains("d-none")) {
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
            
            if (container.classList.contains('d-none')) {
                container.classList.remove('d-none');
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
        })
        .catch((error) => {
            document.getElementById("daftar-dokter").innerHTML =
                "<p>Gagal mengambil data. Silakan coba lagi.</p>";
            console.error("Error:", error);
        });

    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("clinic-option")) {
            const unitId = event.target.getAttribute("data-code");
            getDokterByUnit(unitId);
        }
    });
}

// Jalankan setelah DOM siap
document.addEventListener("DOMContentLoaded", initDokter);
