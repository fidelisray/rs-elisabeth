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

    // Fungsi helper untuk scroll dengan offset (menghindari sticky navbar)
    function scrollToPanel(panel) {
        const offset = 120; // Sesuaikan dengan tinggi navbar Anda (sekitar 120px)
        const y = panel.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top: y, behavior: 'smooth' });
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
                    scrollToPanel(detailPanel);
                }
            }
        });
    });

    // Cek apakah URL memiliki hash (misal #facility-icu) dari klik halaman Beranda
    const hash = window.location.hash;
    let initialTarget = null;

    if (hash) {
        const hashId = hash.substring(1); // Hapus karakter '#'
        const hashBtn = document.querySelector(`.btn-facility[data-target="${hashId}"]`);
        if (hashBtn) {
            initialTarget = hashId;
        }
    }

    // Aktifkan item sesuai hash, atau item pertama jika tidak ada hash
    if (initialTarget) {
        activateFacility(initialTarget);
        
        // Buat efek scroll smooth saat pertama kali halaman dimuat
        setTimeout(() => {
            const detailPanel = document.querySelector('.facility-detail-panel');
            if (detailPanel) {
                scrollToPanel(detailPanel);
            }
        }, 150); // Jeda singkat menunggu render DOM class 'active'
    } else if (facilityButtons.length > 0) {
        const firstTargetId = facilityButtons[0].getAttribute('data-target');
        activateFacility(firstTargetId);
    }
});
