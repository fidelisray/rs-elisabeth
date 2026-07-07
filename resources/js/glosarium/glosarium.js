// public/js/glossary-search.js

// document.addEventListener("DOMContentLoaded", function () {
//     const searchInput = document.getElementById("glossarySearchInput");
//     const resultsBox = document.getElementById("glossarySearchResults");
//     const SEARCH_URL = "/glosarium/cari"; // atau pakai window.route jika ada helper JS route

//     let debounceTimer = null;
//     const DEBOUNCE_DELAY = 350; // ms, silakan disesuaikan

//     searchInput.addEventListener("input", function () {
//         const keyword = this.value.trim();

//         // Batalkan timer sebelumnya setiap kali user mengetik lagi
//         clearTimeout(debounceTimer);

//         if (keyword.length < 2) {
//             hideResults();
//             return;
//         }

//         // Jalankan fetch HANYA setelah user berhenti mengetik selama DEBOUNCE_DELAY
//         debounceTimer = setTimeout(() => {
//             fetchResults(keyword);
//         }, DEBOUNCE_DELAY);
//     });


//     function fetchResults(keyword) {
//         const url = `${SEARCH_URL}?q=${encodeURIComponent(keyword)}`;
//         console.log(url);
        
//         fetch(url, {
//             method: "GET",
//             headers: {
//                 "X-Requested-With": "XMLHttpRequest",
//                 Accept: "application/json",
//             },
//         })
//             .then((response) => {
//                 console.log(response);
                
//                 if (!response.ok) {
//                     throw new Error("Gagal mengambil data pencarian");
//                 }
//                 return response.json();
//             })
//             .then((data) => renderResults(data))
//             .catch((error) => {
//                 console.error(error);
//                 hideResults();
//             });
//     }

//     function renderResults(items) {
//         resultsBox.innerHTML = "";

//         if (items.length === 0) {
//             resultsBox.innerHTML = `
//                 <div class="list-group-item text-muted">
//                     Tidak ada istilah ditemukan.
//                 </div>`;
//             showResults();
//             return;
//         }

//         items.forEach((item) => {
//             const el = document.createElement("a");
//             el.href = "#";
//             el.className = "list-group-item list-group-item-action";
//             el.textContent = item.istilah;

//             // Buka modal detail, bukan pindah halaman
//             el.addEventListener("click", function (e) {
//                 e.preventDefault();
//                 openTermModal(item);
//                 hideResults();
//                 searchInput.value = "";
//             });

//             resultsBox.appendChild(el);
//         });

//         showResults();
//     }

//     function showResults() {
//         resultsBox.style.display = "block";
//     }

//     function hideResults() {
//         resultsBox.style.display = "none";
//         resultsBox.innerHTML = "";
//     }

//     // Sembunyikan dropdown kalau user klik di luar area search
//     document.addEventListener("click", function (e) {
//         if (!resultsBox.contains(e.target) && e.target !== searchInput) {
//             hideResults();
//         }
//     });

//     function openTermModal(item) {
//         // Sesuaikan dengan modal Bootstrap yang sudah kamu buat sebelumnya
//         document.getElementById("termModalLabel").textContent = item.istilah;
//         document.getElementById("termModalBody").textContent = item.deskripsi;

//         const modal = new bootstrap.Modal(document.getElementById("termModal"));
//         modal.show();
//     }
// });




document.addEventListener("DOMContentLoaded", function () {
    const searchForm = document.getElementById("glossarySearchForm");
    const searchInput = document.getElementById("glossarySearchInput");
    const resultsBox = document.getElementById("glossarySearchResults");
    const resetBtn = document.getElementById("resetSearchBtn");
    const defaultContent = document.getElementById("defaultGlossaryContent");

    const SEARCH_URL = "/glosarium/cari";
    let debounceTimer = null;
    const DEBOUNCE_DELAY = 350;

    // 1. Mencegah reload halaman saat user menekan Enter di input
    searchForm.addEventListener("submit", function (e) {
        e.preventDefault();
        const keyword = searchInput.value.trim();
        if (keyword.length >= 2) {
            fetchResults(keyword);
        }
    });

    // 2. Fitur Live Search dengan Debounce saat mengetik
    searchInput.addEventListener("input", function () {
        const keyword = this.value.trim();
        clearTimeout(debounceTimer);

        if (keyword.length < 2) {
            return; // Tunggu sampai minimal 2 karakter, tidak melakukan apa-apa
        }

        debounceTimer = setTimeout(() => {
            fetchResults(keyword);
        }, DEBOUNCE_DELAY);
    });

    // 3. Fitur Reset
    resetBtn.addEventListener("click", function () {
        // Kosongkan input
        searchInput.value = "";

        // Sembunyikan hasil dan tombol reset
        resultsBox.style.display = "none";
        resultsBox.innerHTML = "";
        resetBtn.style.display = "none";

        // Tampilkan kembali konten original halaman
        if (defaultContent) {
            defaultContent.style.display = "block";
        }
    });

    // 4. Fungsi Fetch API
    function fetchResults(keyword) {
        // Tampilkan tombol reset karena pencarian sedang berlangsung
        resetBtn.style.display = "block";

        // Sembunyikan konten utama halaman
        if (defaultContent) {
            defaultContent.style.display = "none";
        }

        // Tampilkan status loading sederhana
        resultsBox.style.display = "block";
        resultsBox.innerHTML = `<div class="text-muted">Mencari istilah "${keyword}"...</div>`;

        const url = `${SEARCH_URL}?q=${encodeURIComponent(keyword)}`;

        fetch(url, {
            method: "GET",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                Accept: "application/json",
            },
        })
            .then((response) => {
                if (!response.ok)
                    throw new Error("Gagal mengambil data pencarian");
                return response.json();
            })
            .then((data) => renderResults(data, keyword))
            .catch((error) => {
                console.error(error);
                resultsBox.innerHTML = `<div class="alert alert-danger">Terjadi kesalahan pada server.</div>`;
            });
    }

    // 5. Render Hasil
    function renderResults(items, keyword) {
        resultsBox.innerHTML = "";

        // Tampilan Jika Data Tidak Ditemukan
        if (items.length === 0) {
            resultsBox.innerHTML = `
                <div class="alert alert-warning">
                    Tidak ada istilah atau deskripsi yang cocok dengan <strong>"${keyword}"</strong>. 
                    Silakan coba kata kunci lain.
                </div>`;
            return;
        }

        // Tampilan Jika Data Ditemukan
        const listGroup = document.createElement("div");
        listGroup.className = "list-group";

        items.forEach((item) => {
            const el = document.createElement("a");
            el.href = "#";
            el.className = "list-group-item list-group-item-action";

            // Format HTML untuk item (bisa disesuaikan dengan kebutuhan UI Anda)
            el.innerHTML = `
                <h5 class="mb-1 text-primary">${item.istilah}</h5>
                <small class="text-muted">${item.deskripsi ? item.deskripsi.substring(0, 100) + "..." : ""}</small>
            `;

            el.addEventListener("click", function (e) {
                e.preventDefault();
                // Panggil fungsi modal Anda di sini
                if (typeof openTermModal === "function") {
                    openTermModal(item);
                } else {
                    console.warn("Fungsi openTermModal belum didefinisikan.");
                }
            });

            listGroup.appendChild(el);
        });

        resultsBox.appendChild(listGroup);
    }

    // 6. Function Open Modal
    // Fungsi untuk membuka modal dan mengisi data
    function openTermModal(item) {
        // 1. Tangkap elemen di dalam modal
        const modalTitle = document.getElementById("modalTermName");
        const modalDesc = document.getElementById("modalTermDescription");
        const modalElement = document.getElementById("termDetailModal");

        // 2. Masukkan data (istilah & deskripsi) ke dalam elemen tersebut
        modalTitle.textContent = item.istilah;
        
        // Gunakan pengecekan jika deskripsinya kosong dari database
        if (item.deskripsi) {
            modalDesc.textContent = item.deskripsi;
        } else {
            modalDesc.innerHTML = "<em>Tidak ada deskripsi tersedia untuk istilah ini.</em>";
        }

        // 3. Panggil dan tampilkan Modal menggunakan instance Bootstrap 5
        // Pastikan script Bootstrap (JS) sudah ter-load di project Anda
        const termModal = new bootstrap.Modal(modalElement);
        termModal.show();
    }
});

