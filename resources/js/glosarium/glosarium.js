// public/js/glossary-search.js

document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("glossarySearchInput");
    const resultsBox = document.getElementById("glossarySearchResults");
    const SEARCH_URL = "/glosarium/cari"; // atau pakai window.route jika ada helper JS route

    let debounceTimer = null;
    const DEBOUNCE_DELAY = 350; // ms, silakan disesuaikan

    searchInput.addEventListener("input", function () {
        const keyword = this.value.trim();

        // Batalkan timer sebelumnya setiap kali user mengetik lagi
        clearTimeout(debounceTimer);

        if (keyword.length < 2) {
            hideResults();
            return;
        }

        // Jalankan fetch HANYA setelah user berhenti mengetik selama DEBOUNCE_DELAY
        debounceTimer = setTimeout(() => {
            fetchResults(keyword);
        }, DEBOUNCE_DELAY);
    });


    function fetchResults(keyword) {
        const url = `${SEARCH_URL}?q=${encodeURIComponent(keyword)}`;
        console.log(url);
        
        fetch(url, {
            method: "GET",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                Accept: "application/json",
            },
        })
            .then((response) => {
                console.log(response);
                
                if (!response.ok) {
                    throw new Error("Gagal mengambil data pencarian");
                }
                return response.json();
            })
            .then((data) => renderResults(data))
            .catch((error) => {
                console.error(error);
                hideResults();
            });
    }

    function renderResults(items) {
        resultsBox.innerHTML = "";

        if (items.length === 0) {
            resultsBox.innerHTML = `
                <div class="list-group-item text-muted">
                    Tidak ada istilah ditemukan.
                </div>`;
            showResults();
            return;
        }

        items.forEach((item) => {
            const el = document.createElement("a");
            el.href = "#";
            el.className = "list-group-item list-group-item-action";
            el.textContent = item.istilah;

            // Buka modal detail, bukan pindah halaman
            el.addEventListener("click", function (e) {
                e.preventDefault();
                openTermModal(item);
                hideResults();
                searchInput.value = "";
            });

            resultsBox.appendChild(el);
        });

        showResults();
    }

    function showResults() {
        resultsBox.style.display = "block";
    }

    function hideResults() {
        resultsBox.style.display = "none";
        resultsBox.innerHTML = "";
    }

    // Sembunyikan dropdown kalau user klik di luar area search
    document.addEventListener("click", function (e) {
        if (!resultsBox.contains(e.target) && e.target !== searchInput) {
            hideResults();
        }
    });

    function openTermModal(item) {
        // Sesuaikan dengan modal Bootstrap yang sudah kamu buat sebelumnya
        document.getElementById("termModalLabel").textContent = item.istilah;
        document.getElementById("termModalBody").textContent = item.deskripsi;

        const modal = new bootstrap.Modal(document.getElementById("termModal"));
        modal.show();
    }
});
