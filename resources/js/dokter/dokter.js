// fetch data dokter

function getDokterByUnit(unitId) {
    document.getElementById('daftar-dokter').innerHTML = '<p>Loading...</p>';

    fetch(`/dokter/${unitId}`)
        .then(response => response.json())
        .then(dokters => {
            console.log(dokters);
            const container = document.getElementById('daftar-dokter');

            if (dokters.length === 0) {
                container.innerHTML = '<p>Tidak ada dokter di unit ini.</p>';
                return;
            }

            const html = dokters.map(dokter => `
                <div class="card-dokter">
                    <h3>${dokter.ParamedicName}</h3>
                    <p>NIP  : ${dokter.ParamedicCode}</p>
                    <p>Unit : ${dokter.ServiceUnitName}</p>
                </div>
            `).join('');

            container.innerHTML = html;
        })
        .catch(error => {
            document.getElementById('daftar-dokter').innerHTML =
                '<p>Gagal mengambil data. Silakan coba lagi.</p>';
            console.error('Error:', error);
        });
}

function initDokter() {
    document.getElementById('daftar-dokter').innerHTML = '<p>Pilih Klinik...</p>';

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('clinic-option')) {
            const unitId = event.target.getAttribute('data-code'); 
            getDokterByUnit(unitId);
        }
    });
}

// Jalankan setelah DOM siap
document.addEventListener('DOMContentLoaded', initDokter);