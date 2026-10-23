# 📋 Cheatsheet & Panduan Presentasi Kelompok 05
> **Mata Kuliah:** Pemrograman Web (Semester 5)  
> **Judul Proyek:** Web Portofolio Terpadu Kelompok 05 (Laravel 13 & MySQL)  
> **Tujuan Dokumen:** Panduan lengkap pembagian peran, alur demo langsung (*live demo*), dan pembekalan teknis (*Q&A Defense*) untuk menghadapi pertanyaan dosen penguji.

---

## ⏱️ 1. Rundown Presentasi (Durasi Ideal: 10 - 15 Menit)

| Waktu | Durasi | Agenda / Materi | Pembicara |
|:---:|:---:|---|---|
| **00:00 - 02:30** | 2.5 Menit | **Pembukaan & Latar Belakang**<br>• Salam pembuka & perkenalan anggota tim (4 orang).<br>• Latar belakang kebutuhan portofolio terpadu.<br>• Gambaran arsitektur sistem (PHP 8.5, Laravel 13, MySQL, Tailwind v4). | **Ahmad Fauzi**<br>*(Ketua & Fullstack)* |
| **02:30 - 05:30** | 3.0 Menit | **Frontend Design System & Showcase Publik**<br>• Konsep desain *Edgy Minimalist Tech Showcase* (Dark mode).<br>• Demonstrasi interaktif: *Instant Category Filtering* tanpa reload.<br>• Demonstrasi Modal detail anggota & karya proyek.<br>• Formulir kontak publik & validasi input. | **Siti Nurhaliza**<br>*(Frontend & UI/UX)* |
| **05:30 - 09:30** | 4.0 Menit | **Backend Architecture & Live Demo CRUD Admin**<br>• Skema database relasional (Members, Projects, Messages, Users).<br>• Demo login admin dengan fitur *Autofill Demo*.<br>• Tinjauan Dashboard Overview & statistik metrik.<br>• Demo operasi CRUD Anggota & Portofolio Proyek (Upload foto & thumbnail).<br>• Manajemen pesan masuk (Toggle baca & hapus). | **Budi Pratama**<br>*(Backend & Database)* |
| **09:30 - 12:30** | 3.0 Menit | **Keamanan, Testing & Kesimpulan**<br>• Keamanan sistem: Proteksi CSRF, Enkripsi Bcrypt, Verifikasi sandi.<br>• Solusi pencegahan N+1 Query via Eager Loading.<br>• Demonstrasi Automated Testing (12 Test Pest PHP lolos 100%).<br>• Penutup & ringkasan pembelajaran Semester 5. | **Rina Anggraini**<br>*(QA & Documentation)* |
| **12:30 - 15:00** | 2.5 Menit | **Sesi Tanya Jawab (Q&A)** dengan Dosen & Audiens. | **Seluruh Tim** |

---

## 🎬 2. Skenario Demo Langsung (Step-by-Step Live Demo)

Saat membuka laptop untuk presentasi, ikuti urutan berikut agar demo terlihat profesional dan tanpa hambatan:

### Langkah 1: Persiapan Sebelum Presentasi
1. Pastikan database MySQL berjalan.
2. Buka terminal 1: `php artisan serve` (berjalan di port `8000`).
3. Buka browser pada alamat `http://localhost:8000`.

### Langkah 2: Demo Halaman Publik (Landing Page)
1. **Hero Section**:
   - Tunjukkan metrik strip: Total 4 Anggota, Total Proyek, PHP 8.5 & Laravel 13, MySQL.
   - Jelaskan konsep *Dark Mode High-Contrast Monospace* yang bersih dan modern.
2. **Section Tim Anggota**:
   - Tunjukkan kartu 4 mahasiswa lengkap dengan NIM resmi.
   - **Klik tombol `[DETAIL] →`** pada salah satu anggota:
     - Tunjukkan foto profil, bio, keahlian (*skills*), nomor telepon, email, serta tautan GitHub/LinkedIn.
     - Tekan tombol `ESC` atau klik di luar untuk menutup modal secara mulus.
3. **Section Portofolio Karya**:
   - Tunjukkan kartu proyek yang berlabel **`UTAMA`** (*featured*).
   - **Klik tombol filter kategori**: `[Web Application]`, `[RESTful API]`, `[UI/UX Design]`.
   - Perlihatkan bagaimana kartu proyek terfilter secara instan di sisi klien (*client-side filtering* tanpa reload halaman).
   - **Klik tombol `[DETAIL →]`** pada salah satu proyek:
     - Tunjukkan nama kontributor utama, tangkapan layar, daftar tech stack, serta tombol GitHub & Demo live.
4. **Section Formulir Kontak**:
   - Isi form kontak (Nama: `Dosen Penguji`, Email: `dosen@univ.ac.id`, Pesan: `Website kelompok ini sangat baik dan rapi`).
   - Klik **`Kirim Pesan →`**.
   - Tunjukkan banner hijau sukses: *"Terima kasih! Pesan Anda telah terkirim kepada tim kami."*

### Langkah 3: Demo Autentikasi & Dashboard Admin
1. **Navigasi ke Login**:
   - Klik tautan **`[ PORTAL_LOGIN → ]`** di footer atau buka `/login`.
   - Tunjukkan fitur **`[GUNAKAN]`** autofill kredensial cepat:
     - Email: `admin@kelompok.test`
     - Password: `password`
   - Klik **`Masuk ke Sistem →`**.
2. **Dashboard Overview**:
   - Tunjukkan kartu statistik: 4 Anggota, 5 Proyek, jumlah pesan masuk.
   - Tunjukkan status `MYSQL ONLINE` dan ringkasan aktivitas terbaru.
3. **Modul Pesan Masuk (`/dashboard/messages`)**:
   - Buka menu Pesan Masuk.
   - Tunjukkan pesan yang baru saja dikirim pada form publik di Langkah 2!
   - Klik tombol **`[TANDAI SUDAH DIBACA]`** (Status otomatis berubah, badge angka di sidebar berkurang).
4. **Modul CRUD Anggota (`/dashboard/members`)**:
   - Tunjukkan tabel anggota dengan pencarian instan (ketik NIM atau nama pada kotak pencarian).
   - Klik **`+ Tambah Anggota`** atau klik **`EDIT`** pada salah satu anggota.
   - Tunjukkan fitur *live preview* saat memilih foto baru.
5. **Modul CRUD Portofolio (`/dashboard/projects`)**:
   - Tunjukkan tabel proyek dengan filter kategori dropdown.
   - Tunjukkan bagaimana proyek dapat dihubungkan ke anggota tim tertentu atau seluruh tim.
6. **Modul Pengaturan Akun (`/dashboard/profile`)**:
   - Tunjukkan bahwa perubahan kata sandi dilindungi oleh validasi verifikasi sandi lama (*current password*).
7. **Logout**:
   - Klik tombol **`[KELUAR]`**.
   - Sistem mengakhiri sesi, me-regenerasi token CSRF, dan mengembalikan pengunjung ke landing page dengan banner informasi.

---

## 🎯 3. Top 10 Pertanyaan Dosen & Kunci Jawaban Teknis (Q&A Defense)

Kuasai 10 pertanyaan teknis berikut. Setiap anggota wajib memahami konsep di baliknya:

### Q1: *"Bagaimana alur request lifecycle dari browser hingga halaman tampil di layar?"*
> **Jawaban Teknis:**
> 1. Request masuk ke `public/index.php` sebagai *entry point*.
> 2. Composer autoloader memuat seluruh class dan dependensi.
> 3. Framework bootstrap membuat instance *Application* dan mengirim request ke *HTTP Kernel*.
> 4. Request melewati rangkaian middleware (seperti Session, CSRF protection, Authentication).
> 5. Router (`routes/web.php`) mencocokkan URI dan memanggil Controller yang bersangkutan (`HomeController@index`).
> 6. Controller memanggil Model Eloquent (`Member` dan `Project`) untuk mengambil data dari database MySQL.
> 7. Controller mengembalikan View Blade (`resources/views/home.blade.php`) dengan menyertakan data.
> 8. Blade Engine mengompilasi template menjadi HTML murni dan mengirimkannya sebagai HTTP Response berstatus 200 OK ke browser.

---

### Q2: *"Apa itu masalah N+1 Query Problem, dan bagaimana kelompok Anda menanganinya?"*
> **Jawaban Teknis:**
> Masalah N+1 terjadi jika kita mengambil data relasi di dalam perulangan (loop). Misalnya ada 10 proyek: jika kita memanggil `$project->member->name` tanpa optimasi, Laravel akan menjalankan 1 query untuk mengambil 10 proyek, ditambah 10 query terpisah untuk masing-masing member (total 11 query).  
> **Solusi Kami:**  
> Kami menerapkan **Eager Loading** menggunakan method `with()`.
> ```php
> // Di HomeController:
> $members = Member::with('projects')->get();
> $projects = Project::with('member')->get();
> ```
> Dengan cara ini, Laravel hanya mengeksekusi **2 query SQL optimal** menggunakan klausul `WHERE IN (...)`, terlepas dari berapapun jumlah datanya.

---

### Q3: *"Bagaimana aplikasi melindungi diri dari serangan SQL Injection dan Cross-Site Scripting (XSS)?"*
> **Jawaban Teknis:**
> 1. **SQL Injection:** Dieliminasi karena kami menggunakan **Eloquent ORM** dan **Query Builder**. Laravel secara default membungkus seluruh query menggunakan **PDO Prepared Statements** dan *parameter binding*, sehingga input pengguna tidak pernah dieksekusi sebagai perintah SQL mentah.
> 2. **XSS (Cross-Site Scripting):** Pada Blade templating, kami menggunakan sintaks double curly braces `{{ $data }}` yang otomatis menjalankan fungsi PHP `htmlspecialchars()` untuk meng-escape karakter berbahaya seperti `<`, `>`, `&`, dan `"`.
> 3. **Input Sanitization:** Seluruh input form divalidasi dengan `$request->validate()` sebelum diproses ke database.

---

### Q4: *"Bagaimana mekanisme proteksi CSRF bekerja pada formulir aplikasi ini?"*
> **Jawaban Teknis:**
> Saat sesi pengguna dibuat, Laravel menghasilkan sebuah token kriptografi acak yang disimpan dalam sesi pengguna. Pada setiap form HTML (`POST`, `PUT`, `DELETE`), kami menyematkan direktif `@csrf` yang membuat input tersembunyi `_token`.  
> Middleware `ValidateCsrfToken` akan membandingkan token dari formulir dengan token yang tersimpan di sesi server. Jika ada pihak luar yang memalsukan request (*Cross-Site Request Forgery*), token tidak cocok dan request langsung ditolak dengan kode status **419 Page Expired**.

---

### Q5: *"Bagaimana relasi database dirancang pada tabel `members` dan `projects`? Apa yang terjadi jika anggota dihapus?"*
> **Jawaban Teknis:**
> Relasi yang digunakan adalah **One-to-Many**:
> - Pada model `Member`: `public function projects() { return $this->hasMany(Project::class); }`
> - Pada model `Project`: `public function member() { return $this->belongsTo(Member::class); }`
> 
> Pada berkas migrasi, kami mendefinisikan:
> ```php
> $table->foreignId('member_id')->nullable()->constrained('members')->nullOnDelete();
> ```
> Opsi `nullOnDelete()` menjamin **Integritas Referensial**: Jika salah satu anggota kelompok dihapus, baris data proyek karyanya **tidak akan ikut terhapus**, melainkan nilai foreign key `member_id`-nya diset menjadi `NULL` (dialihkan statusnya menjadi kontribusi bersama seluruh tim).

---

### Q6: *"Bagaimana proses pengunggahan file gambar ditangani dan disimpan?"*
> **Jawaban Teknis:**
> 1. **Validasi:** File divalidasi bertipe gambar (`image`), format diperbolehkan (`jpeg, png, jpg, webp, svg`), dan ukuran maksimum dibatasi (misal 3-4 MB).
> 2. **Penyimpanan:** File disimpan ke disk `public` menggunakan `$request->file('photo')->store('members', 'public')`. File disimpan di direktori internal aman `storage/app/public/members/`.
> 3. **Akses Web Publik:** Kami menjalankan `php artisan storage:link` yang membuat *symbolic link* dari `public/storage` ke `storage/app/public`.
> 4. **Pembersihan Berkas Usang:** Saat data anggota/proyek diperbarui atau dihapus, sistem memeriksa keberadaan file lama dan menghapusnya dari disk menggunakan `Storage::disk('public')->delete(...)` untuk mencegah penumpukan sampah berkas di server.

---

### Q7: *"Bagaimana sistem modal popup mengambil data anggota dan proyek tanpa error karakter kutip atau broken image?"*
> **Jawaban Teknis:**
> Kami menggunakan arsitektur **JSON Data Store**:
> 1. Data model disuntikkan secara aman ke dalam tag `<script type="application/json" id="data-members">@json($members)</script>`.
> 2. Pada model `Member` dan `Project`, kami mendefinisikan array `$appends` untuk accessor dinamis:
>    - `Member`: `$appends = ['skills_array', 'photo_url'];`
>    - `Project`: `$appends = ['tech_stack_array', 'image_url'];`
> 3. Tombol modal hanya memanggil `openMemberModal(id)` dengan operan ID integer sederhana. Fungsi JavaScript kemudian mencari data berdasarkan ID dalam store JSON. Pendekatan ini 100% bebas dari risiko konflik tanda kutip ganda (`"`) atau baris baru (`\n`) pada teks deskripsi.

---

### Q8: *"Apa perbedaan mendasar antara method PUT, PATCH, dan DELETE pada rute aplikasi ini?"*
> **Jawaban Teknis:**
> Ini mengikuti konvensi arsitektur RESTful:
> - **PUT:** Digunakan untuk memperbarui resource secara menyeluruh (misal: `dashboard.members.update` menggantikan seluruh field data profil anggota).
> - **PATCH:** Digunakan untuk modifikasi parsial pada atribut tertentu saja (misal: `dashboard.messages.toggle` hanya membalikkan status boolean `is_read` dari pesan tanpa mengubah isi pesan).
> - **DELETE:** Digunakan untuk menghapus resource secara permanen dari database (misal: `dashboard.projects.destroy`).  
> Karena browser HTML form standar hanya mendukung `GET` dan `POST`, Laravel menyediakan *method spoofing* dengan direktif `@method('PUT')`, `@method('PATCH')`, dan `@method('DELETE')`.

---

### Q9: *"Bagaimana kalian memisahkan hak akses antara pengunjung biasa dan administrator?"*
> **Jawaban Teknis:**
> Kami mengimplementasikan **Route Middleware**:
> - Rute Publik (`/`, `/contact`) tidak memiliki middleware pembatas sehingga dapat diakses siapa saja.
> - Rute Guest (`/login`, `/register`) menggunakan middleware `'guest'`. Jika pengguna sudah memiliki sesi login aktif, mereka otomatis dialihkan ke dashboard.
> - Rute Panel CRUD (`/dashboard/*`) dikelompokkan dalam middleware `'auth'`. Pengunjung yang belum terotentikasi akan otomatis diblokir dan diarahkan ke formulir login.

---

### Q10: *"Bagaimana kalian menguji keandalan sistem ini?"*
> **Jawaban Teknis:**
> Kami membuat suite pengujian otomatis menggunakan **Pest PHP** (`tests/Feature/PortfolioSystemTest.php`) dengan 12 skenario pengujian yang mencakup:
> 1. Render halaman landing page dan query relasi.
> 2. Proteksi middleware auth pada dashboard.
> 3. Autentikasi sesi login yang valid.
> 4. Siklus lengkap CRUD Anggota Kelompok.
> 5. Siklus lengkap CRUD Portofolio Proyek.
> 6. Penyimpanan pesan kontak dari formulir publik.
> 7. Serialisasi JSON dan atribut `$appends` model.
> 8. Pencegahan pengubahan password tanpa *current password*.
> 9. Pembaruan profil dan password yang terverifikasi.
> 10. Validasi format email pada kontak masuk.  
> Semua pengujian dijalankan dengan `php artisan test` dan menghasilkan status **12 passed (52 assertions)**.

---

## 💡 4. Tips Mental & Sikap Saat Presentasi di Depan Dosen

1. **Bicara Terstruktur:** Gunakan pola *Masalah → Solusi Teknis → Hasil*.  
   *Contoh:* *"Kendala umum web portofolio kelompok adalah tampilan yang terpisah-pisah. Solusi kami adalah membangun arsitektur terpadu berbasis Laravel dengan database relasional MySQL sehingga data 4 anggota dapat dikelola dari satu dashboard terpusat."*
2. **Jangan Panik Saat Dosen Meminta Live Demo:**  
   Jika dosen meminta: *"Coba tambahkan proyek baru sekarang"*, buka `/dashboard/projects/create`, isi form, upload gambar, lalu buka tab landing page publik untuk menunjukkan bahwa proyek langsung muncul di halaman depan.
3. **Bagi Pertanyaan dengan Kompak:**  
   - Pertanyaan desain / UI / CSS → Serahkan ke **Siti Nurhaliza**.
   - Pertanyaan database / query / controller → Serahkan ke **Budi Pratama**.
   - Pertanyaan arsitektur / routing / login → Dijawab oleh **Ahmad Fauzi**.
   - Pertanyaan testing / validasi / bug handling → Dijawab oleh **Rina Anggraini**.
4. **Bila Tidak Mengetahui Jawaban:**  
   Hindari menjawab asal. Gunakan jawaban diplomatis: *"Terima kasih atas pertanyaannya Pak/Bu. Pada implementasi saat ini kami menerapkan pendekatan X karena alasan Y. Masukan Bapak/Ibu mengenai Z tentu akan menjadi evaluasi optimasi lanjutan pada codebase kami."*

---

<p align="center">
  <b>Semoga Presentasi Besok Berjalan Lancar & Sukses Meraih Nilai Terbaik (A)!</b>
</p>
