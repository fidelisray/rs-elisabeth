/**
 * navbar-dropdown.js
 *
 * Mengubah trigger dropdown .nav-tentang-kami dari "klik" menjadi "hover".
 * - Membuka  : saat cursor memasuki .nav-tentang-kami (mouseenter)
 * - Menutup  : saat cursor meninggalkan .nav-tentang-kami (mouseleave)
 *              dengan delay agar user punya waktu untuk memindahkan
 *              cursor ke dalam dropdown-menu tanpa dropdown langsung tutup.
 *
 * Animasi (fade + slide) dikendalikan sepenuhnya via CSS (navbar-dropdown.css).
 * File ini hanya menambah / menghapus class `.hover-open` pada elemen li.
 */

(function () {
    "use strict";

    // -----------------------------------------------------------------------
    // Konfigurasi
    // -----------------------------------------------------------------------
    const CLOSE_DELAY_MS = 280; // ms delay sebelum dropdown tertutup

    // -----------------------------------------------------------------------
    // Bootstrap 5 mungkin masih mem-bind listener "klik" pada dropdown-toggle.
    // Kita nonaktifkan itu dengan menghapus atribut data-bs-toggle setelah DOM
    // siap, tapi tetap mempertahankan class dropdown-toggle agar CSS Bootstrap
    // (posisi, z-index, dll.) masih berlaku.
    // -----------------------------------------------------------------------
    function disableBootstrapClickToggle(navItem) {
        const toggle = navItem.querySelector(".nav-link.dropdown-toggle");
        if (!toggle) return;

        // Hapus atribut yang membuat Bootstrap "mendengarkan" klik
        toggle.removeAttribute("data-bs-toggle");
        toggle.removeAttribute("data-bs-target");

        // Cegah klik nav-link memicu navigasi (href="#") yang tidak perlu
        toggle.addEventListener("click", function (e) {
            e.preventDefault();
        });
    }

    // -----------------------------------------------------------------------
    // Pasang logika hover pada satu nav-item
    // -----------------------------------------------------------------------
    function attachHoverDropdown(navItem) {
        let closeTimer = null;

        // --- Fungsi buka ---
        function openDropdown() {
            if (closeTimer) {
                clearTimeout(closeTimer);
                closeTimer = null;
            }
            navItem.classList.add("hover-open");
        }

        // --- Fungsi tutup (dengan delay) ---
        function scheduleClose() {
            closeTimer = setTimeout(function () {
                navItem.classList.remove("hover-open");
                closeTimer = null;
            }, CLOSE_DELAY_MS);
        }

        // Listener pada seluruh li.nav-item (mencakup nav-link + dropdown-menu)
        navItem.addEventListener("mouseenter", openDropdown);
        navItem.addEventListener("mouseleave", scheduleClose);
    }

    // -----------------------------------------------------------------------
    // Init — jalankan setelah DOM siap
    // -----------------------------------------------------------------------
    function init() {
        const navTentangKami = document.querySelector(".nav-tentang-kami");
        if (!navTentangKami) return; // guard: elemen tidak ditemukan

        disableBootstrapClickToggle(navTentangKami);
        attachHoverDropdown(navTentangKami);
    }

    // Gunakan DOMContentLoaded agar aman diload sebelum atau sesudah body
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", init);
    } else {
        init(); // DOM sudah siap (script dimuat di akhir body / async)
    }
})();
