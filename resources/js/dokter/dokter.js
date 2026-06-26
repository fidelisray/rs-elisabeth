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


const DAYS = [1, 2, 3, 4, 5, 6];

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
                schedule[day] = []
            });
            

            doctorMap.set(item.ParamedicCode, {
                paramedic_code: item.ParamedicCode,
                paramedic_name: item.ParamedicName,
                schedule,
                // schedule: new Map(),
            });
        }

        const doc = doctorMap.get(item.ParamedicCode);

        doc.schedule[item.DayNumber].push({
            jam: item.OperationalTimeName.split('|'),
            serviceUnitCode: item.ServiceUnitCode,
            serviceUnitName: item.ServiceUnitName
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


function getMaxSlot(schedule) {
    return Math.max(...Object.values(schedule).map((day) => day.length));
}

function renderHeader(grid) {

		const today = new Date().getDay();

    const hariIndonesia = {
        1: "Senin",
        2: "Selasa",
        3: "Rabu",
        4: "Kamis",
        5: "Jumat",
        6: "Sabtu",
      };

    DAYS.forEach((day) => {
        const header = document.createElement("div");
        header.classList.add("day-header");

				if (day === today) {
					header.classList.add('today');
				}

        header.textContent = hariIndonesia[day];

        grid.appendChild(header);
    });
}


function createScheduleCard(jam, serviceUnitName, day) {
    const card = document.createElement("div");
    card.classList.add("schedule-card");
    
		const today = new Date().getDay();

		if (day === today) { card.classList.add('today-card') }

    // item.jam.forEach((jam) => {

    // });
    card.innerHTML = `
        <span class="sc-time">${jam}</span>
        <span class="sc-klinik">${serviceUnitName}</span>
    `;

    return card;
}


function createEmptyCard() {
    const card = document.createElement("div");
    card.classList.add("schedule-card", "empty-card");

    return card;
}


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
							col.appendChild(createScheduleCard(jam, item.serviceUnitName, day));
						});
        });

        const emptyCount = maxSlot - schedule[day].length;

        for (let i = 0; i < emptyCount; i++) {
            col.appendChild(createEmptyCard());
        }

        grid.appendChild(col);
    });
}


function getDoctorCard(doctor_list) {
    const html = doctor_list
			.map((dokter) => `
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

function getDokter(specialtyCode) {
    fetch(`/dokter/${specialtyCode}`)
        .then((response) => response.json())
        .then((data) => {

            const dummy_layout = document.getElementById('coba-layout-baru');


            // dummy_layout.innerHTML = `
            //     <div class="container py-4">
            //         <div class="jadwal-wrapper">
            //             <h2 class="jadwal-title">Jadwal Dokter</h2>

            //             <div class="jadwal-scroll">
            //                 <div class="jadwal-grid" id="jadwalGrid">


            //                 </div>{{-- end jadwal-grid --}}
            //             </div>{{-- end jadwal-scroll --}}
            //         </div>{{-- end jadwal-wrapper --}}
            //     </div>
            // `;


            const { LeaveSchedule, ScheduleByDay, ScheduleRoutine } = data;

            const doctor_list = preprocessingApiData(ScheduleRoutine);
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

					dummy_layout.innerHTML = html;
					doctor_list.forEach((doctor) => {
							renderSchedule(doctor);
					});

        })
        .catch((error) => {
            // document.getElementById("daftar-dokter").innerHTML =
            //     "<p>Gagal mengambil data. Silakan coba lagi.</p>";
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
            getDokter(unitId);
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
