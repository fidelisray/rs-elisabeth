/**
 * Facilities & Services Page — Interactive Tab JS
 * Mengelola klik tab fasilitas di kolom kiri
 * dan menampilkan detail di kolom kanan.
 */

document.addEventListener('DOMContentLoaded', () => {
    const facilityButtons = document.querySelectorAll('.btn-facility');
    const facilityDetails = document.querySelectorAll('.facility-detail-item');

    function activateFacility(targetId) {
        // Reset semua tombol
        facilityButtons.forEach(btn => btn.classList.remove('active'));

        // Reset semua detail panel
        facilityDetails.forEach(detail => detail.classList.remove('active'));

        // Aktifkan tombol yang diklik
        const activeBtn = document.querySelector(`.btn-facility[data-target="${targetId}"]`);
        if (activeBtn) activeBtn.classList.add('active');

        // Tampilkan detail panel yang sesuai
        const activeDetail = document.getElementById(targetId);
        if (activeDetail) activeDetail.classList.add('active');
    }

    // Event listener untuk setiap tombol
    facilityButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-target');
            activateFacility(targetId);

            // Scroll smooth ke panel detail di mobile
            if (window.innerWidth < 992) {
                const detailPanel = document.querySelector('.facility-detail-panel');
                if (detailPanel) {
                    detailPanel.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        });
    });

    // Aktifkan item pertama secara default
    if (facilityButtons.length > 0) {
        const firstTargetId = facilityButtons[0].getAttribute('data-target');
        activateFacility(firstTargetId);
    }
});
