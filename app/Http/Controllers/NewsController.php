<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Dummy data for news articles.
     * Later this will be replaced by API calls.
     */
    private function getDummyNews()
    {
        return [
            [
                'id' => 1,
                'title' => 'Teknologi Robotik Terbaru untuk Operasi Tulang Belakang Hadir di RS St. Elisabeth',
                'slug' => Str::slug('Teknologi Robotik Terbaru untuk Operasi Tulang Belakang Hadir di RS St. Elisabeth'),
                'image' => asset('images/hero.jpg'),
                'date' => '2026-07-20',
                'excerpt' => 'RS St. Elisabeth Semarang kembali menghadirkan inovasi medis terdepan dengan mengadopsi teknologi robotik canggih untuk operasi tulang belakang...',
                'content' => '
                    <p>RS St. Elisabeth Semarang kembali menghadirkan inovasi medis terdepan dengan mengadopsi teknologi robotik canggih untuk operasi tulang belakang. Inovasi ini menjadikan rumah sakit ini sebagai salah satu pelopor penggunaan sistem bedah robotik di Jawa Tengah.</p>
                    <p>Teknologi baru ini memungkinkan tingkat akurasi tinggi dan meminimalkan risiko kerusakan pada saraf selama prosedur bedah. Pasien yang menjalani operasi tulang belakang menggunakan metode ini juga dilaporkan mengalami proses pemulihan yang jauh lebih cepat dibandingkan dengan metode konvensional.</p>
                    <p>"Kami berkomitmen untuk terus berinovasi demi keselamatan dan kenyamanan pasien. Teknologi robotik ini adalah langkah besar dalam layanan bedah ortopedi kami," ungkap Direktur Medis RS St. Elisabeth.</p>
                '
            ],
            [
                'id' => 2,
                'title' => 'RS St. Elisabeth Raih Penghargaan Rumah Sakit Ramah Lingkungan 2026',
                'slug' => Str::slug('RS St. Elisabeth Raih Penghargaan Rumah Sakit Ramah Lingkungan 2026'),
                'image' => asset('images/feature.jpg'),
                'date' => '2026-07-18',
                'excerpt' => 'Penghargaan bergengsi kembali diraih oleh RS St. Elisabeth Semarang sebagai Rumah Sakit Ramah Lingkungan (Green Hospital) terbaik tingkat nasional tahun ini.',
                'content' => '
                    <p>Penghargaan bergengsi kembali diraih oleh RS St. Elisabeth Semarang sebagai Rumah Sakit Ramah Lingkungan (Green Hospital) terbaik tingkat nasional tahun ini. Penghargaan ini diberikan oleh Kementerian Kesehatan dan Kementerian Lingkungan Hidup.</p>
                    <p>Prestasi ini tidak lepas dari berbagai inisiatif hijau yang diterapkan, seperti pengelolaan limbah medis yang terpadu, pengurangan penggunaan plastik sekali pakai, serta implementasi energi panel surya untuk menekan emisi karbon operasional.</p>
                '
            ],
            [
                'id' => 3,
                'title' => 'Mengenal Layanan Klinik Nyeri Terpadu: Solusi Bebas Nyeri Tanpa Operasi',
                'slug' => Str::slug('Mengenal Layanan Klinik Nyeri Terpadu: Solusi Bebas Nyeri Tanpa Operasi'),
                'image' => asset('images/F1670914854.jpg'),
                'date' => '2026-07-15',
                'excerpt' => 'Gangguan nyeri kronis seringkali menurunkan kualitas hidup. Kini, pasien dapat memanfaatkan Layanan Klinik Nyeri Terpadu di RS St. Elisabeth...',
                'content' => '
                    <p>Gangguan nyeri kronis seringkali menurunkan kualitas hidup. Kini, pasien dapat memanfaatkan Layanan Klinik Nyeri Terpadu di RS St. Elisabeth, yang menawarkan pendekatan intervensi minimal (tanpa operasi bedah besar).</p>
                    <p>Dengan teknik radiofrekuensi, injeksi blok saraf, dan neurostimulasi, tim spesialis nyeri kami mampu menangani nyeri tulang belakang, sendi, hingga nyeri saraf akibat diabetes dan pasca-stroke secara efektif.</p>
                '
            ],
            [
                'id' => 4,
                'title' => 'Pentingnya Deteksi Dini Kanker Payudara Lewat Mammografi 3D',
                'slug' => Str::slug('Pentingnya Deteksi Dini Kanker Payudara Lewat Mammografi 3D'),
                'image' => asset('images/F1670220299.jpg'),
                'date' => '2026-07-10',
                'excerpt' => 'Kanker payudara masih menjadi salah satu ancaman kesehatan terbesar bagi wanita di Indonesia. Oleh karena itu, deteksi dini sangatlah krusial.',
                'content' => '
                    <p>Kanker payudara masih menjadi salah satu ancaman kesehatan terbesar bagi wanita di Indonesia. Oleh karena itu, deteksi dini sangatlah krusial. RS St. Elisabeth telah melengkapi unit radiologinya dengan mesin Mammografi 3D (Tomosynthesis).</p>
                    <p>Alat ini memberikan citra yang jauh lebih tajam dan akurat, sehingga mampu mendeteksi kelainan sekecil apa pun pada jaringan payudara yang mungkin tidak terlihat pada mammogram konvensional (2D).</p>
                '
            ]
        ];
    }

    public function index()
    {
        // TODO: In the future, fetch news from the API Service here.
        // $response = Http::get('API_URL/news');
        // $newsList = $response->json();
        
        $newsList = collect($this->getDummyNews())->sortByDesc('date')->values()->all();

        return view('news.index', compact('newsList'));
    }

    public function show($slug)
    {
        // TODO: In the future, fetch single news from the API Service here.
        // $response = Http::get("API_URL/news/{$slug}");
        // $news = $response->json();

        $newsList = collect($this->getDummyNews());
        $news = $newsList->firstWhere('slug', $slug);

        if (!$news) {
            abort(404);
        }

        return view('news.show', compact('news'));
    }
}
