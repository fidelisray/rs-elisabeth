<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jadwal Dokter</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    /* =====================
       Jadwal Dokter Styles
       ===================== */

    .jadwal-wrapper {
      padding: 1.5rem 0;
    }

    .jadwal-title {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 1.25rem;
      color: #212529;
    }

    /* Scroll horizontal di mobile */
    .jadwal-scroll {
      overflow-x: auto;
    }

    /* Grid 7 kolom: 1 per hari */
    .jadwal-grid {
      display: grid;
      grid-template-columns: repeat(7, minmax(120px, 1fr));
      gap: 8px;
      min-width: 860px;
    }

    /* ---- Header hari ---- */
    .day-header {
      text-align: center;
      padding: 10px 6px;
      border-radius: 8px;
      font-size: 0.8rem;
      font-weight: 600;
      background-color: #f8f9fa;
      color: #6c757d;
      border: 1px solid #dee2e6;
    }

    .day-header.today {
      background-color: #4caf50;
      color: #fff;
      border-color: #4caf50;
    }

    /* ---- Kolom slot ---- */
    .slot-col {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    /* ---- Card jadwal ---- */
    .schedule-card {
      border-radius: 8px;
      border: 1px solid #dee2e6;
      background-color: #fff;
      padding: 10px;
      font-size: 0.78rem;
      min-height: 78px;
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .schedule-card .sc-time {
      font-weight: 600;
      color: #212529;
      font-size: 0.8rem;
    }

    .schedule-card .sc-klinik {
      font-size: 0.75rem;
      color: #6c757d;
    }

    /* Badge serviceUnit */
    .sc-badge {
      display: inline-block;
      margin-top: 4px;
      padding: 2px 8px;
      border-radius: 20px;
      font-size: 0.7rem;
      font-weight: 600;
      width: fit-content;
    }

    .sc-badge.regular   { background-color: #e8f5e9; color: #2e7d32; }
    .sc-badge.specialist { background-color: #e3f2fd; color: #1565c0; }
    .sc-badge.executive  { background-color: #fff3e0; color: #e65100; }
    .sc-badge.online     { background-color: #f3e5f5; color: #6a1b9a; }

    /* Card hari ini — hijau */
    .schedule-card.today-card {
      background-color: #4caf50;
      border-color: #4caf50;
    }

    .schedule-card.today-card .sc-time  { color: #fff; }
    .schedule-card.today-card .sc-klinik { color: rgba(255,255,255,0.85); }

    /* Override badge warna saat di dalam today-card */
    .schedule-card.today-card .sc-badge {
      background-color: rgba(255,255,255,0.25);
      color: #fff;
    }

    /* Hari libur / tidak ada jadwal */
    .schedule-card.empty-card {
      background-color: #f8f9fa;
      border: 1px dashed #dee2e6;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #adb5bd;
      font-size: 0.72rem;
      min-height: 60px;
    }

    .schedule-card.empty-card.today-empty {
      background-color: rgba(76, 175, 80, 0.08);
      border-color: rgba(76, 175, 80, 0.35);
      color: rgba(76, 175, 80, 0.7);
    }
  </style>
</head>
<body>

<div class="container py-4">
  <div class="jadwal-wrapper">
    <h2 class="jadwal-title">Jadwal Dokter</h2>

    {{--
      ================================================================
      TARGET RENDER — hanya elemen kosong ini yang perlu ada di Blade.
      Semua konten dirender oleh renderJadwalDokter() di bawah.
      ================================================================
    --}}
    <div class="jadwal-scroll">
      <div class="jadwal-grid" id="jadwalGrid"></div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
/**
 * ================================================================
 * JADWAL DOKTER — Dynamic Renderer
 * ================================================================
 *
 * CARA PAKAI DI LARAVEL:
 *
 * 1. Taruh elemen target di Blade:
 *      <div class="jadwal-grid" id="jadwalGrid"></div>
 *
 * 2. Kirim data dari controller ke Blade:
 *      return view('dokter.show', ['dokter' => $dokterData]);
 *
 * 3. Pass data ke JS di Blade:
 *      <script>
 *        const dokterData = @json($dokter);
 *        renderJadwalDokter('jadwalGrid', dokterData);
 *      </script>
 *
 * ================================================================
 */

// ------------------------------------------------------------------
// CONFIG: mapping serviceUnit → label tampilan
// Tambah/ubah sesuai data dari API kamu
// ------------------------------------------------------------------
const SERVICE_UNIT_LABEL = {
  regular:    'Klinik Regular',
  specialist: 'Klinik Spesialis',
  executive:  'Klinik Eksekutif',
  online:     'Klinik Online',
};

// ------------------------------------------------------------------
// CONFIG: urutan hari & label tampilan
// ------------------------------------------------------------------
const HARI_LIST = [
  { key: 'senin',   label: 'Senin'   },
  { key: 'selasa',  label: 'Selasa'  },
  { key: 'rabu',    label: 'Rabu'    },
  { key: 'kamis',   label: 'Kamis'   },
  { key: 'jumat',   label: "Jum'at"  },
  { key: 'sabtu',   label: 'Sabtu'   },
  { key: 'minggu',  label: 'Minggu'  },
];

// Mapping JS getDay() (0=Minggu) → key hari
const JS_DAY_TO_KEY = ['minggu','senin','selasa','rabu','kamis','jumat','sabtu'];

// ------------------------------------------------------------------
// HELPER: normalisasi label serviceUnit
// ------------------------------------------------------------------
function getServiceLabel(serviceUnit) {
  const key = (serviceUnit || '').toLowerCase();
  return SERVICE_UNIT_LABEL[key] || serviceUnit;
}

// ------------------------------------------------------------------
// HELPER: normalisasi badge class serviceUnit
// ------------------------------------------------------------------
function getBadgeClass(serviceUnit) {
  const key = (serviceUnit || '').toLowerCase();
  if (SERVICE_UNIT_LABEL[key]) return key;
  return 'regular'; // fallback
}

// ------------------------------------------------------------------
// HELPER: buat satu schedule-card dari satu slot jadwal
// ------------------------------------------------------------------
function buatScheduleCard(slot, isToday) {
  const cardClass  = isToday ? 'schedule-card today-card' : 'schedule-card';
  const badgeClass = 'sc-badge ' + getBadgeClass(slot.serviceUnit);
  const label      = getServiceLabel(slot.serviceUnit);

  return `
    <div class="${cardClass}">
      <span class="sc-time">${slot.jam}</span>
      <span class="sc-badge ${getBadgeClass(slot.serviceUnit)}">${label}</span>
    </div>
  `;
}

// ------------------------------------------------------------------
// HELPER: buat empty-card (hari libur / tidak ada jadwal)
// ------------------------------------------------------------------
function buatEmptyCard(isToday) {
  const extraClass = isToday ? ' today-empty' : '';
  return `<div class="schedule-card empty-card${extraClass}">Tidak ada jadwal</div>`;
}

// ------------------------------------------------------------------
// MAIN: render jadwal satu dokter ke dalam elemen target
//
// @param {string} targetId   — id elemen .jadwal-grid di DOM
// @param {object} dokter     — satu objek dokter dari response API
// ------------------------------------------------------------------
function renderJadwalDokter(targetId, dokter) {
  const grid    = document.getElementById(targetId);
  const todayKey = JS_DAY_TO_KEY[new Date().getDay()];

  if (!grid) {
    console.error('[JadwalDokter] Elemen #' + targetId + ' tidak ditemukan.');
    return;
  }

  // -- Normalisasi: buat lookup jadwal per hari dari data API --
  // Hasil: { senin: [ {jam, serviceUnit}, ... ], selasa: [...], ... }
  const jadwalMap = {};
  (dokter.jadwal || []).forEach(function(item) {
    const hariKey = (item.hari || '').toLowerCase();
    jadwalMap[hariKey] = item.detail || [];
  });

  let html = '';

  // -- BARIS 1: Header hari --
  HARI_LIST.forEach(function(hari) {
    const isToday   = hari.key === todayKey;
    const todayClass = isToday ? ' today' : '';
    html += `<div class="day-header${todayClass}">${hari.label}</div>`;
  });

  // -- BARIS 2+: Kolom slot per hari --
  HARI_LIST.forEach(function(hari) {
    const isToday = hari.key === todayKey;
    const slots   = jadwalMap[hari.key]; // undefined jika hari tidak ada di API

    html += '<div class="slot-col">';

    // Skenario 1 — hari ada di API: render semua slot (bisa >1)
    if (slots && slots.length > 0) {
      slots.forEach(function(slot) {
        html += buatScheduleCard(slot, isToday);
      });

    // Skenario 2 — hari tidak ada di API: tampilkan empty-card
    } else {
      html += buatEmptyCard(isToday);
    }

    html += '</div>';
  });

  grid.innerHTML = html;
}


// ================================================================
// CONTOH — data dummy yang meniru struktur response API kamu.
// Di Laravel, ganti blok ini dengan:
//
//   const dokterData = @json($dokter);
//   renderJadwalDokter('jadwalGrid', dokterData);
//
// ================================================================
const dokterData = {
  id: "01",
  name: "dr. Pico Santoso, Sp.PD",
  jadwal: [
    {
      hari: "senin",
      detail: [
        { jam: "08:00 - 09:00", serviceUnit: "regular" },
        { jam: "12:00 - 13:00", serviceUnit: "specialist" }
      ]
    },
    {
      hari: "selasa",
      detail: [
        { jam: "08:00 - 09:00", serviceUnit: "executive" },
        { jam: "13:00 - 15:00", serviceUnit: "specialist" },
        { jam: "17:00 - 18:00", serviceUnit: "regular" }
      ]
    },
    {
      hari: "kamis",
      detail: [
        { jam: "09:00 - 11:00", serviceUnit: "specialist" }
      ]
    },
    {
      hari: "sabtu",
      detail: [
        { jam: "08:00 - 10:00", serviceUnit: "regular" },
        { jam: "10:30 - 12:00", serviceUnit: "online" }
      ]
    }
    // rabu, jumat, minggu tidak ada → otomatis empty-card
  ]
};

renderJadwalDokter('jadwalGrid', dokterData);
</script>

</body>
</html>
