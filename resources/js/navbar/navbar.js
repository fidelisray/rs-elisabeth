const sentinel = document.getElementById("navbar-sentinel");
const navbar = document.getElementById("second-navbar");

// Saat sentinel keluar dari viewport (artinya halaman sudah men-scroll
// melewati posisi awal navbar), berarti navbar sudah "menempel" di atas.
const observer = new IntersectionObserver(
    ([entry]) => {
        navbar.classList.toggle("is-stuck", !entry.isIntersecting);
    },
    { threshold: 0 },
);

observer.observe(sentinel);