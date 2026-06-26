<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Jadwal Dokter</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        .jadwal-wrapper {
            padding: 1.5rem 0;
        }

        .jadwal-scroll {
            overflow-x: auto;
        }

        .jadwal-grid {
            display: grid;
            grid-template-columns: repeat(7, minmax(130px, 1fr));
            gap: 8px;
            min-width: 900px;
        }

        .day-header {
            text-align: center;
            padding: 10px;
            border-radius: 8px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            font-weight: 600;
        }

        .day-header.today {
            background: #4caf50;
            border-color: #4caf50;
            color: white;
        }

        .slot-col {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .schedule-card {
            min-height: 80px;
            padding: 10px;
            border-radius: 8px;
            background: white;
            border: 1px solid #dee2e6;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .schedule-card.today-card {
            background: #4caf50;
            border-color: #4caf50;
            color: white;
        }

        .schedule-card.empty-card {
            background: transparent;
            border-color: transparent;
            pointer-events: none;
        }

        .sc-time {
            font-weight: 600;
        }

        .sc-klinik {
            font-size: .85rem;
            color: #6c757d;
        }

        .today-card .sc-klinik {
            color: rgba(255,255,255,.9);
        }
    </style>
</head>
<body>

<div class="container py-5">

    <h2 class="mb-4">
        Jadwal Dokter
    </h2>

    <div class="mb-4">
        <label class="form-label">
            Pilih Dokter
        </label>

        <select
            id="doctorSelect"
            class="form-select"
        >
        </select>
    </div>

    <div class="jadwal-scroll">
        <div
            class="jadwal-grid"
            id="jadwalGrid"
        ></div>
    </div>

</div>

<script>

const DAYS = [
    'senin',
    'selasa',
    'rabu',
    'kamis',
    'jumat',
    'sabtu',
    'minggu'
];

const DAY_LABEL = {
    senin: 'Senin',
    selasa: 'Selasa',
    rabu: 'Rabu',
    kamis: 'Kamis',
    jumat: "Jum'at",
    sabtu: 'Sabtu',
    minggu: 'Minggu'
};

const dokterList = [
    {
        id: '01',
        name: 'dr. Pico',
        jadwal: {
            senin: [
                {
                    jam: '08:00 - 09:00',
                    serviceUnit: 'Regular'
                },
                {
                    jam: '13:00 - 15:00',
                    serviceUnit: 'Specialist'
                }
            ],
            selasa: [
                {
                    jam: '10:00 - 12:00',
                    serviceUnit: 'Executive'
                }
            ],
            rabu: [],
            kamis: [
                {
                    jam: '08:00 - 10:00',
                    serviceUnit: 'Regular'
                }
            ],
            jumat: [],
            sabtu: [],
            minggu: []
        }
    },

    {
        id: '02',
        name: 'dr. Sparky',
        jadwal: {
            senin: [],
            selasa: [
                {
                    jam: '08:00 - 09:00',
                    serviceUnit: 'Specialist'
                },
                {
                    jam: '13:00 - 15:00',
                    serviceUnit: 'Regular'
                }
            ],
            rabu: [
                {
                    jam: '08:00 - 12:00',
                    serviceUnit: 'Executive'
                }
            ],
            kamis: [],
            jumat: [],
            sabtu: [],
            minggu: []
        }
    },

    {
        id: '03',
        name: 'dr. Joko',
        jadwal: {
            senin: [
                {
                    jam: '08:00 - 10:00',
                    serviceUnit: 'Executive'
                }
            ],
            selasa: [],
            rabu: [],
            kamis: [],
            jumat: [
                {
                    jam: '08:00 - 09:00',
                    serviceUnit: 'Regular'
                },
                {
                    jam: '10:00 - 12:00',
                    serviceUnit: 'Specialist'
                },
                {
                    jam: '15:00 - 18:00',
                    serviceUnit: 'Executive'
                }
            ],
            sabtu: [],
            minggu: []
        }
    },

    {
        id: '04',
        name: 'dr. Widodo',
        jadwal: {
            senin: [],
            selasa: [],
            rabu: [],
            kamis: [],
            jumat: [],
            sabtu: [
                {
                    jam: '08:00 - 09:00',
                    serviceUnit: 'Regular'
                }
            ],
            minggu: [
                {
                    jam: '09:00 - 11:00',
                    serviceUnit: 'Specialist'
                },
                {
                    jam: '13:00 - 15:00',
                    serviceUnit: 'Executive'
                }
            ]
        }
    }
];

function getToday()
{
    const days = [
        'minggu',
        'senin',
        'selasa',
        'rabu',
        'kamis',
        'jumat',
        'sabtu'
    ];

    return days[new Date().getDay()];
}

function getMaxSlot(jadwal)
{
    return Math.max(
        ...Object.values(jadwal)
            .map(item => item.length),
        1
    );
}

function createScheduleCard(item, isToday)
{
    const card =
        document.createElement('div');

    card.classList.add('schedule-card');

    if (isToday) {
        card.classList.add('today-card');
    }

    card.innerHTML = `
        <span class="sc-time">
            ${item.jam}
        </span>

        <span class="sc-klinik">
            ${item.serviceUnit}
        </span>
    `;

    return card;
}

function createEmptyCard()
{
    const card =
        document.createElement('div');

    card.classList.add(
        'schedule-card',
        'empty-card'
    );

    return card;
}

function renderSchedule(doctor)
{
    const grid =
        document.getElementById(
            'jadwalGrid'
        );

    grid.innerHTML = '';

    const today =
        getToday();

    DAYS.forEach(day => {

        const header =
            document.createElement('div');

        header.classList.add(
            'day-header'
        );

        if (day === today) {
            header.classList.add(
                'today'
            );
        }

        header.textContent =
            DAY_LABEL[day];

        grid.appendChild(header);
    });

    const maxSlot =
        getMaxSlot(
            doctor.jadwal
        );

    DAYS.forEach(day => {

        const col =
            document.createElement('div');

        col.classList.add(
            'slot-col'
        );

        doctor.jadwal[day]
            .forEach(item => {

                col.appendChild(
                    createScheduleCard(
                        item,
                        day === today
                    )
                );

            });

        const empty =
            maxSlot -
            doctor.jadwal[day].length;

        for (
            let i = 0;
            i < empty;
            i++
        ) {
            col.appendChild(
                createEmptyCard()
            );
        }

        grid.appendChild(col);
    });
}

function initDoctorSelect()
{
    const select =
        document.getElementById(
            'doctorSelect'
        );

    dokterList.forEach(
        (doctor, index) => {

            const option =
                document.createElement(
                    'option'
                );

            option.value = index;
            option.textContent =
                doctor.name;

            select.appendChild(
                option
            );
        }
    );

    select.addEventListener(
        'change',
        function () {
            renderSchedule(
                dokterList[this.value]
            );
        }
    );

    renderSchedule(
        dokterList[0]
    );
}

initDoctorSelect();

</script>

</body>
</html>