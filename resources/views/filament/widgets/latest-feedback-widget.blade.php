<x-filament-widgets::widget>
    <x-filament::section>

        {{-- ── CSS: Adaptasi Dark / Light Mode ─────────────────────────────── --}}
        <style>
            .fb-card {
                display: flex;
                flex-direction: column;
                gap: 1rem;
                border-radius: 0.75rem;
                padding: 1.25rem;
                background-color: #f3f4f6;
                border: 1px solid #e5e7eb;
                min-height: 160px;
                transition: background-color 0.2s ease, border-color 0.2s ease;
            }
            .dark .fb-card {
                background-color: #1f2937;
                border-color: #374151;
            }

            .fb-comment {
                font-size: 0.875rem;
                line-height: 1.6;
                color: #374151;
                flex: 1;
                margin: 0;
                overflow: hidden;
                display: -webkit-box;
                -webkit-line-clamp: 4;
                -webkit-box-orient: vertical;
            }
            .dark .fb-comment { color: #e5e7eb; }

            .fb-divider {
                border: none;
                border-top: 1px solid #d1d5db;
                margin: 0;
            }
            .dark .fb-divider { border-top-color: #374151; }

            .fb-name {
                font-size: 0.875rem;
                font-weight: 600;
                color: #111827;
                margin: 0;
                line-height: 1.3;
            }
            .dark .fb-name { color: #f9fafb; }

            .fb-date {
                font-size: 0.75rem;
                color: #6b7280;
                margin: 0.2rem 0 0 0;
            }
            .dark .fb-date { color: #9ca3af; }

            /* ── Filter Bar ─────────────────────────────── */
            .fb-filter-bar {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 0.5rem;
                margin-bottom: 1rem;
            }
            .fb-filter-label {
                font-size: 0.8rem;
                font-weight: 600;
                color: #6b7280;
                margin-right: 0.25rem;
                white-space: nowrap;
            }
            .dark .fb-filter-label { color: #9ca3af; }

            .fb-btn {
                font-size: 0.75rem;
                font-weight: 500;
                padding: 0.35rem 0.85rem;
                border-radius: 9999px;
                border: 1px solid #d1d5db;
                background-color: #ffffff;
                color: #374151;
                cursor: pointer;
                transition: all 0.15s ease;
                white-space: nowrap;
            }
            .dark .fb-btn {
                border-color: #4b5563;
                background-color: #1f2937;
                color: #d1d5db;
            }
            .fb-btn:hover {
                border-color: #f59e0b;
                color: #d97706;
            }
            .dark .fb-btn:hover {
                border-color: #f59e0b;
                color: #fbbf24;
            }
            .fb-btn-active {
                background-color: #f59e0b !important;
                border-color: #f59e0b !important;
                color: #ffffff !important;
                font-weight: 600;
            }
            .dark .fb-btn-active { color: #1f2937 !important; }

            /* ── Separator ─────────────────────────────── */
            .fb-separator {
                width: 1px;
                height: 20px;
                background: #d1d5db;
            }
            .dark .fb-separator { background: #4b5563; }

            /* ── Empty State ────────────────────────────── */
            .fb-empty {
                grid-column: 1 / -1;
                text-align: center;
                padding: 2.5rem 1rem;
                color: #9ca3af;
                font-size: 0.875rem;
            }
        </style>

        {{-- ── Header ─────────────────────────────────────────────────────── --}}
        <x-slot name="heading">Ulasan Pelanggan Terbaru</x-slot>
        <x-slot name="description">
            Menampilkan {{ count($feedbackList) }} ulasan terbaru dari pasien RS Elisabeth
        </x-slot>

        {{-- ── Alpine.js Component ─────────────────────────────────────────── --}}
        <div
            x-data="{
                allReviews: {{ \Illuminate\Support\Js::from($feedbackList) }},
                sort: 'newest',
                starFilter: 0,

                get filteredReviews() {
                    let result = [...this.allReviews];

                    // Filter by star count (0 = semua)
                    if (this.starFilter > 0) {
                        result = result.filter(r => parseInt(r.rating) === this.starFilter);
                    }

                    // Sort
                    if (this.sort === 'newest') {
                        result.sort((a, b) => new Date(b.date) - new Date(a.date));
                    } else if (this.sort === 'oldest') {
                        result.sort((a, b) => new Date(a.date) - new Date(b.date));
                    } else if (this.sort === 'highest') {
                        result.sort((a, b) => parseInt(b.rating) - parseInt(a.rating));
                    } else if (this.sort === 'lowest') {
                        result.sort((a, b) => parseInt(a.rating) - parseInt(b.rating));
                    }

                    return result;
                },

                setSort(val) { this.sort = val; },
                setStarFilter(val) { this.starFilter = (this.starFilter === val) ? 0 : val; },

                renderStars(rating) {
                    const r = Math.max(1, Math.min(5, parseInt(rating) || 0));
                    const starSvgFull = '<svg width=\'16\' height=\'16\' viewBox=\'0 0 20 20\' fill=\'#f59e0b\' style=\'flex-shrink:0; width:16px; height:16px; display:inline-block;\'><path d=\'M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z\'/></svg>';
                    const starSvgEmpty = '<svg width=\'16\' height=\'16\' viewBox=\'0 0 20 20\' fill=\'#6b7280\' style=\'flex-shrink:0; width:16px; height:16px; display:inline-block;\'><path d=\'M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z\'/></svg>';
                    let html = '';
                    for (let i = 1; i <= 5; i++) { html += (i <= r) ? starSvgFull : starSvgEmpty; }
                    return html;
                }
            }"
        >

            {{-- ── Filter Bar ─────────────────────────────────────────────── --}}
            <div class="fb-filter-bar">

                {{-- Sort: Waktu --}}
                <span class="fb-filter-label">Urutkan:</span>
                <button
                    class="fb-btn"
                    :class="{ 'fb-btn-active': sort === 'newest' }"
                    @click="setSort('newest')"
                >Terbaru</button>
                <button
                    class="fb-btn"
                    :class="{ 'fb-btn-active': sort === 'oldest' }"
                    @click="setSort('oldest')"
                >Terlama</button>

                <div class="fb-separator"></div>

                {{-- Sort: Rating --}}
                <span class="fb-filter-label">Rating:</span>
                <button
                    class="fb-btn"
                    :class="{ 'fb-btn-active': sort === 'highest' }"
                    @click="setSort('highest')"
                >Tertinggi</button>
                <button
                    class="fb-btn"
                    :class="{ 'fb-btn-active': sort === 'lowest' }"
                    @click="setSort('lowest')"
                >Terendah</button>

                <div class="fb-separator"></div>

                {{-- Filter: Per Bintang --}}
                <span class="fb-filter-label">Bintang:</span>
                <template x-for="star in [5, 4, 3, 2, 1]" :key="star">
                    <button
                        class="fb-btn"
                        :class="{ 'fb-btn-active': starFilter === star }"
                        @click="setStarFilter(star)"
                        x-text="star + '★'"
                    ></button>
                </template>
                <button
                    class="fb-btn"
                    :class="{ 'fb-btn-active': starFilter === 0 }"
                    @click="setStarFilter(0)"
                >Semua</button>
            </div>

            {{-- ── Badge jumlah hasil ──────────────────────────────────────── --}}
            <p style="font-size:0.75rem; color:#9ca3af; margin-bottom:0.75rem;" x-show="filteredReviews.length > 0">
                Menampilkan <span x-text="filteredReviews.length" style="font-weight:600;"></span> ulasan
            </p>

            {{-- ── Card Grid ─────────────────────────────────────────────── --}}
            <div style="
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
                gap: 1rem;
            ">
                {{-- Empty state ketika filter tidak menemukan data --}}
                <template x-if="filteredReviews.length === 0">
                    <div class="fb-empty">
                        Tidak ada ulasan untuk filter yang dipilih.
                    </div>
                </template>

                {{-- Loop cards --}}
                <template x-for="(review, index) in filteredReviews" :key="index">
                    <div class="fb-card">
                        {{-- Bintang --}}
                        <div style="display:flex; align-items:center; gap:2px; flex-shrink:0;"
                            x-html="renderStars(review.rating)">
                        </div>

                        {{-- Komentar --}}
                        <p class="fb-comment">
                            &ldquo;<span x-text="review.comment"></span>&rdquo;
                        </p>

                        {{-- Divider --}}
                        <hr class="fb-divider">

                        {{-- Nama & Tanggal --}}
                        <div>
                            <p class="fb-name" x-text="review.name"></p>
                            <p class="fb-date" x-text="review.date"></p>
                        </div>
                    </div>
                </template>
            </div>

        </div>
        {{-- ── End Alpine Component ─────────────────────────────────────────── --}}

    </x-filament::section>
</x-filament-widgets::widget>
