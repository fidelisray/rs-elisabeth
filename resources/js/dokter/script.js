const scheduleButtons =
document.querySelectorAll('.schedule-btn:not(:disabled)');

const selectedSchedule =
    document.getElementById('selectedSchedule');

const bookBtn =
    document.getElementById('bookBtn');

let selectedDay = '';
let selectedTime = '';

scheduleButtons.forEach(button => {

    button.addEventListener('click', function() {

        scheduleButtons.forEach(btn => {
            btn.classList.remove('selected');
        });

        this.classList.add('selected');

        selectedDay = this.dataset.day;
        selectedTime = this.dataset.time;

        selectedSchedule.innerHTML =
            `${selectedDay}<br>${selectedTime}`;

        bookBtn.disabled = false;

    });

});

bookBtn.addEventListener('click', () => {

    if(!selectedDay) return;

    alert(
        `Booking Appointment\n\n${selectedDay}\n${selectedTime}`
    );

});
// console.log(bookBtn);





const radios = document.querySelectorAll('.poli-radio');


radios.forEach(radio => {

    radio.addEventListener('change', () => {

        radios.forEach(r => {
            if (r !== radio) {
                r.dataset.checked = 'false';
            }
        });

        radio.dataset.checked = 'true';
    });

    const label = document.querySelector(`label[for="${radio.id}"]`);

    label.addEventListener('click', e => {

        if (radio.checked && radio.dataset.checked === 'true') {
            e.preventDefault();

            radio.checked = false;
            radio.dataset.checked = 'false';
        }
    });

});


// *******************************
// ---- Dropdown Pilih Klinik ----
// *******************************
const clinicSearch = document.getElementById('clinicSearch');
const clinicOptions = document.querySelectorAll('.clinic-option');
const dropdownButton = document.getElementById('clinicDropdown');

// Filter Klinik

clinicSearch.addEventListener('keyup', function () {

    const keyword = this.value.toLowerCase();

    clinicOptions.forEach(option => {
        const clinicName = option.textContent.toLowerCase();
        option.style.display = clinicName.includes(keyword) ? 'block' : 'none';
    });

});


// Pilih Klinik

clinicOptions.forEach(option => {

    option.addEventListener('click', function () {

        const selected_name = this.dataset.value;
        const selected_code = this.dataset.code;

        dropdownButton.innerText = selected_name;
        dropdownButton.dataset.selected_name = selected_name;
        dropdownButton.dataset.selected_code = selected_code;

    });

});


// Reset

document
    .getElementById('btnReset').addEventListener('click', () => {

        dropdownButton.innerText = 'Pilih Klinik';

        // dropdownButton.dataset.selected = '';
        dropdownButton.dataset.selected_name = '';
        dropdownButton.dataset.selected_code = '';

        clinicSearch.value = '';

        document.getElementById('searchKeyword').value = '';

        clinicOptions.forEach(option => {
            option.style.display = 'block';
        });

    });


// Cari

document.getElementById('btnCari').addEventListener('click', () => {

    const clinic_name = dropdownButton.dataset.selected_name;
    const clinic_code = dropdownButton.dataset.selected_code;
    // const clinic = dropdownButton.dataset.selected;

    const keyword = document.getElementById('searchKeyword').value;

    console.log({clinic_name, clinic_code, keyword});

    window.location.href = `/dokter/${clinic_code}`;
});



// modal dokter
const detailDokter = document.getElementById('detailDokter');

detailDokter.addEventListener('show.bs.modal', (event) => {

    const button = event.relatedTarget;

    const namaDokter = button.dataset.nama;
    const jadwalDokter = JSON.parse(button.dataset.jadwal);

    document.getElementById('namaDokter').textContent = namaDokter;
    
    let scheduleCard = '';
    
    jadwalDokter.forEach(jadwal => {
        let scheduleTime = '';
        jadwal.jam.map(waktu => {
            scheduleTime += `
                <span class="schedule-time">${waktu}</span>
            `
        });
        scheduleCard += `
            <div class="schedule-card">
                <div class="day-badge">${jadwal.hari}</div>

                <div>
                    <div class="schedule-day">${jadwal.hari}</div>
                    ${scheduleTime}
                </div>
            </div>
        `
    });
    
    document.getElementById('schedule-cards').innerHTML = scheduleCard;

})