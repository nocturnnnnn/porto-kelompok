<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\Member;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Admin Default
        $admin = User::firstOrCreate(
            ['email' => 'admin@kelompok.test'],
            [
                'name' => 'Admin Kelompok 5',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Data 4 Anggota Kelompok
        $membersData = [
            [
                'name' => 'Ahmad Fauzi',
                'nim' => '230101001',
                'role' => 'Ketua Kelompok & Fullstack Developer',
                'email' => 'ahmad.fauzi@student.univ.ac.id',
                'phone' => '081234567891',
                'bio' => 'Mahasiswa Teknik Informatika Semester 5 dengan minat mendalam pada arsitektur web modern, Laravel ecosystem, dan perancangan database relasional yang scalable.',
                'skills' => 'PHP, Laravel, MySQL, REST API, Tailwind CSS, Git',
                'photo' => null,
                'github_url' => 'https://github.com/',
                'linkedin_url' => 'https://linkedin.com/',
                'instagram_url' => 'https://instagram.com/',
                'order' => 1,
            ],
            [
                'name' => 'Siti Nurhaliza',
                'nim' => '230101002',
                'role' => 'Frontend Developer & UI/UX Designer',
                'email' => 'siti.nurhaliza@student.univ.ac.id',
                'phone' => '081234567892',
                'bio' => 'Spesialis desain antarmuka dan interaksi pengguna. Fokus membuat pengalaman web yang estetis, mudah diakses, mobile-friendly, dan sesuai standar modern.',
                'skills' => 'HTML5, CSS3, Tailwind CSS, JavaScript, Figma, UI/UX Design',
                'photo' => null,
                'github_url' => 'https://github.com/',
                'linkedin_url' => 'https://linkedin.com/',
                'instagram_url' => 'https://instagram.com/',
                'order' => 2,
            ],
            [
                'name' => 'Budi Pratama',
                'nim' => '230101003',
                'role' => 'Backend & Database Engineer',
                'email' => 'budi.pratama@student.univ.ac.id',
                'phone' => '081234567893',
                'bio' => 'Menangani logika bisnis backend, autentikasi sesi yang aman, optimasi query database SQL, serta validasi data input aplikasi.',
                'skills' => 'PHP, Laravel, MySQL, Query Optimization, Postman, Security',
                'photo' => null,
                'github_url' => 'https://github.com/',
                'linkedin_url' => 'https://linkedin.com/',
                'instagram_url' => 'https://instagram.com/',
                'order' => 3,
            ],
            [
                'name' => 'Rina Anggraini',
                'nim' => '230101004',
                'role' => 'Quality Assurance & Frontend Specialist',
                'email' => 'rina.anggraini@student.univ.ac.id',
                'phone' => '081234567894',
                'bio' => 'Memastikan integritas seluruh fungsionalitas CRUD, responsivitas tampilan di berbagai ukuran layar, serta dokumentasi laporan pengerjaan kelompok.',
                'skills' => 'Quality Assurance, Blackbox Testing, Responsive Web, Blade, JavaScript',
                'photo' => null,
                'github_url' => 'https://github.com/',
                'linkedin_url' => 'https://linkedin.com/',
                'instagram_url' => 'https://instagram.com/',
                'order' => 4,
            ],
        ];

        $members = [];
        foreach ($membersData as $data) {
            $members[] = Member::updateOrCreate(['nim' => $data['nim']], $data);
        }

        // 3. Proyek Portofolio
        $projectsData = [
            [
                'title' => 'Web Portofolio Terpadu Kelompok 5',
                'slug' => 'web-portofolio-terpadu-kelompok-5',
                'category' => 'Web Application',
                'excerpt' => 'Aplikasi web portofolio terpadu untuk 4 anggota kelompok dengan fitur CRUD lengkap dan otentikasi login admin berbasis Laravel & MySQL.',
                'description' => "Proyek ini dirancang untuk menggabungkan profil dan rekam jejak karya 4 anggota kelompok dalam satu portal representatif. Dilengkapi antarmuka landing page modern, filter portofolio interaktif, panel admin manajemen data anggota dan karya, serta sistem pesan masuk.\n\nFitur Utama:\n- Autentikasi Pengguna (Login, Register, Logout)\n- Dashboard Statistik & Metrik Proyek\n- CRUD Anggota Kelompok (Foto, NIM, Bio, Keahlian, Sosmed)\n- CRUD Portofolio Proyek (Upload Gambar, Relasi Kontributor, Kategori, Tech Stack)\n- Form Kontak & Manajemen Pesan Masuk\n- Desain Responsif & Modern menggunakan Tailwind CSS",
                'image' => null,
                'member_id' => $members[0]->id,
                'tech_stack' => 'Laravel 13, Tailwind CSS, MySQL, Vite, Blade',
                'demo_url' => 'http://localhost:8000',
                'github_url' => 'https://github.com/',
                'is_featured' => true,
            ],
            [
                'title' => 'Sistem Inventaris & Penjualan UMKM',
                'slug' => 'sistem-inventaris-dan-penjualan-umkm',
                'category' => 'Web Application',
                'excerpt' => 'Platform manajemen stok barang dagangan, pencatatan transaksi kasir harian, dan laporan rekap omset otomatis.',
                'description' => "Aplikasi berbasis web untuk membantu pencatatan barang masuk dan keluar toko retail kecil menengah. Menghilangkan pencatatan manual di buku kasir dengan sistem database relasional yang terintegrasi.\n\nFitur Utama:\n- Manajemen Master Data Produk & Kategori\n- Pencatatan Transaksi Masuk dan Keluar\n- Peringatan Otomatis untuk Stok Menipis\n- Laporan Transaksi Harian dan Bulanan",
                'image' => null,
                'member_id' => $members[2]->id,
                'tech_stack' => 'Laravel, MySQL, Tailwind CSS, Alpine.js',
                'demo_url' => 'https://example.com/demo-umkm',
                'github_url' => 'https://github.com/',
                'is_featured' => true,
            ],
            [
                'title' => 'Desain Antarmuka EduCampus Portal',
                'slug' => 'desain-antarmuka-educampus-portal',
                'category' => 'UI/UX Design',
                'excerpt' => 'Rancangan desain antarmuka pengguna interaktif berkonsep clean dan human-centered untuk portal informasi akademik kampus.',
                'description' => "Eksplorasi antarmuka digital yang mempermudah mahasiswa dalam mengakses jadwal kuliah mingguan, pengumuman dosen, dan pengumpulan tugas terstruktur.\n\nHighlight:\n- Sistem Desain Komponen Konsisten (Color Palette, Typography, Iconography)\n- Prototipe Interaktif High-Fidelity di Figma\n- Testing Usability dengan feedback kepuasan 92%",
                'image' => null,
                'member_id' => $members[1]->id,
                'tech_stack' => 'Figma, UI/UX Research, Design System, Tailwind CSS',
                'demo_url' => 'https://figma.com/',
                'github_url' => 'https://github.com/',
                'is_featured' => true,
            ],
            [
                'title' => 'RESTful API Manajemen Tugas Kuliah',
                'slug' => 'restful-api-manajemen-tugas-kuliah',
                'category' => 'RESTful API',
                'excerpt' => 'Layanan endpoint API backend yang aman untuk aplikasi manajemen tugas, deadline reminder, dan filter status pengerjaan.',
                'description' => "Service backend yang menyediakan endpoint CRUD lengkap dengan format JSON terstandarisasi, validasi data otomatis, enkripsi bearer token autentikasi, serta dokumentasi API interaktif.\n\nEndpoint Tersedia:\n- POST /api/auth/login\n- GET /api/tasks (dengan pagination & search)\n- POST /api/tasks (tambah tugas baru)\n- PUT /api/tasks/{id} (update status tugas)\n- DELETE /api/tasks/{id} (hapus tugas)",
                'image' => null,
                'member_id' => $members[0]->id,
                'tech_stack' => 'PHP 8.5, Laravel, MySQL, Postman, REST API',
                'demo_url' => null,
                'github_url' => 'https://github.com/',
                'is_featured' => false,
            ],
            [
                'title' => 'Aplikasi Survei & Evaluasi Praktikum Web',
                'slug' => 'aplikasi-survei-dan-evaluasi-praktikum-web',
                'category' => 'Web Application',
                'excerpt' => 'Aplikasi web formulir survei kepuasan praktikum dengan visualisasi persentase hasil umpan balik interaktif.',
                'description' => "Aplikasi pengumpulan tanggapan mahasiswa terhadap modul praktikum semester 5. Menampilkan rekapitulasi data dalam bentuk grafik visual yang informatif bagi asisten dosen.\n\nFitur:\n- Form Dinamis dengan validasi client dan server\n- Rekapitulasi Rata-rata Skor per Modul\n- Ekspor Hasil ke Format Tabel",
                'image' => null,
                'member_id' => $members[3]->id,
                'tech_stack' => 'Laravel, Chart.js, Tailwind CSS, MySQL',
                'demo_url' => 'https://example.com/demo-survei',
                'github_url' => 'https://github.com/',
                'is_featured' => false,
            ],
        ];

        foreach ($projectsData as $pData) {
            Project::updateOrCreate(['slug' => $pData['slug']], $pData);
        }

        // 4. Sample Feedback Messages
        ContactMessage::firstOrCreate(
            ['email' => 'dosen.pengampu@univ.ac.id'],
            [
                'name' => 'Dosen Pengampu Pemrograman Web',
                'subject' => 'Apresiasi Pengerjaan Portofolio Kelompok',
                'message' => 'Desain website kelompok sudah sangat rapi, fitur CRUD dan autentikasi login berfungsi dengan baik. Siapkan materi untuk presentasi minggu depan.',
                'is_read' => true,
            ]
        );

        ContactMessage::firstOrCreate(
            ['email' => 'mahasiswa.lain@univ.ac.id'],
            [
                'name' => 'Rangga Wijaya',
                'subject' => 'Tanya implementasi Laravel & Tailwind',
                'message' => 'Halo teman-teman kelompok 5, apakah ada kendala saat deploy di server lokal? Tampilan UI kalian keren sekali.',
                'is_read' => false,
            ]
        );
    }
}
