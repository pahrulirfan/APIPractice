# Requirements Document

## Introduction

Project ini adalah aplikasi Laravel untuk latihan membangun RESTful API. Tujuannya adalah menyediakan endpoint API yang dapat dikonsumsi oleh klien mobile maupun Python. Fitur dibagi menjadi dua kelompok: **API Publik** (tanpa autentikasi) untuk Post dan Comment, serta **API Terproteksi** (memerlukan autentikasi token) untuk User, Pasien, dan Penyakit. Selain endpoint API, project ini juga menyediakan halaman dokumentasi berbasis Blade + Bootstrap yang menjelaskan cara penggunaan setiap endpoint.

Batasan desain: maksimal 5 kolom data per tabel (tidak termasuk `id` dan `timestamps`) untuk menjaga kesederhanaan latihan.

---

## Glossary

- **API**: Application Programming Interface — antarmuka berbasis HTTP yang mengembalikan respons JSON.
- **API_Server**: Aplikasi Laravel yang menangani semua request API dan halaman dokumentasi.
- **Auth_Middleware**: Mekanisme autentikasi berbasis token (Laravel Sanctum) yang melindungi endpoint tertentu.
- **Public_API**: Kelompok endpoint yang dapat diakses tanpa token autentikasi.
- **Protected_API**: Kelompok endpoint yang hanya dapat diakses dengan token autentikasi yang valid.
- **Post**: Entitas konten publik dengan kolom: `title`, `body`, `author`, `slug`, `status`. Satu Post dapat memiliki banyak Comment (relasi one-to-many).
- **Comment**: Entitas komentar yang selalu terhubung ke tepat satu Post melalui foreign key `post_id`, dengan kolom tambahan: `name`, `email`, `body`, `status`. Satu Comment tidak dapat berdiri sendiri tanpa Post induknya.
- **User**: Entitas pengguna sistem dengan kolom: `name`, `email`, `password`, `role`, `is_active`.
- **Pasien**: Entitas data pasien dengan kolom: `nama`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `no_telepon`.
- **Penyakit**: Entitas data penyakit dengan kolom: `kode_icd`, `nama`,  `deskripsi`, `kategori`.
- **Diagnosa**: Relasi many-to-many antara Pasien dan Penyakit, disimpan di tabel pivot `diagnosa`.
- **Token**: String autentikasi yang diterbitkan oleh API_Server setelah login berhasil.
- **Blade_View**: Template HTML Laravel yang dirender server-side untuk halaman dokumentasi.
- **JSON_Response**: Format respons standar API dalam bentuk JSON.

---

## Requirements

### Requirement 1: Autentikasi API

**User Story:** Sebagai developer klien (mobile/Python), saya ingin dapat login dan logout melalui API, sehingga saya bisa mendapatkan token untuk mengakses endpoint yang terproteksi.

#### Acceptance Criteria

1. WHEN pengguna mengirim request `POST /api/login` dengan `email` dan `password` yang valid, THE API_Server SHALL mengembalikan JSON_Response berisi `token` dan data `user` dengan HTTP status 200.
2. IF pengguna mengirim request `POST /api/login` dengan `email` atau `password` yang tidak valid, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan error dengan HTTP status 401.
3. WHEN pengguna mengirim request `POST /api/logout` dengan Token yang valid di header `Authorization: Bearer {token}`, THE API_Server SHALL mencabut Token tersebut dan mengembalikan JSON_Response konfirmasi dengan HTTP status 200.
4. IF pengguna mengirim request ke endpoint Protected_API tanpa Token atau dengan Token yang tidak valid, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan error dengan HTTP status 401.
5. THE API_Server SHALL menerbitkan Token menggunakan Laravel Sanctum.

---

### Requirement 2: CRUD Post (API Publik)

**User Story:** Sebagai developer klien, saya ingin mengakses data Post tanpa perlu login, sehingga saya bisa berlatih mengonsumsi API publik.

#### Acceptance Criteria

1. WHEN klien mengirim request `GET /api/posts`, THE API_Server SHALL mengembalikan JSON_Response berisi daftar semua Post dengan HTTP status 200.
2. WHEN klien mengirim request `GET /api/posts/{id}` dengan `id` yang ada, THE API_Server SHALL mengembalikan JSON_Response berisi data satu Post dengan HTTP status 200.
3. IF klien mengirim request `GET /api/posts/{id}` dengan `id` yang tidak ada, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan error dengan HTTP status 404.
4. WHEN klien mengirim request `POST /api/posts` dengan data `title`, `body`, `author`, `slug`, dan `status` yang valid, THE API_Server SHALL menyimpan Post baru dan mengembalikan JSON_Response berisi data Post yang dibuat dengan HTTP status 201.
5. IF klien mengirim request `POST /api/posts` dengan data yang tidak lengkap atau tidak valid, THEN THE API_Server SHALL mengembalikan JSON_Response berisi daftar pesan validasi dengan HTTP status 422.
6. WHEN klien mengirim request `PUT /api/posts/{id}` dengan `id` yang ada dan data yang valid, THE API_Server SHALL memperbarui Post dan mengembalikan JSON_Response berisi data Post yang diperbarui dengan HTTP status 200.
7. IF klien mengirim request `PUT /api/posts/{id}` dengan `id` yang tidak ada, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan error dengan HTTP status 404.
8. WHEN klien mengirim request `DELETE /api/posts/{id}` dengan `id` yang ada, THE API_Server SHALL menghapus Post beserta semua Comment yang terhubung dan mengembalikan JSON_Response konfirmasi dengan HTTP status 200.
9. IF klien mengirim request `DELETE /api/posts/{id}` dengan `id` yang tidak ada, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan error dengan HTTP status 404.
10. THE API_Server SHALL memastikan nilai `slug` pada tabel Post bersifat unik.
11. WHEN klien mengirim request `GET /api/posts/{id}` dengan `id` yang ada, THE API_Server SHALL menyertakan daftar Comment milik Post tersebut di dalam JSON_Response.

---

### Requirement 3: CRUD Comment (API Publik)

**User Story:** Sebagai developer klien, saya ingin mengakses dan mengelola Comment yang terhubung ke Post tanpa perlu login, sehingga saya bisa berlatih relasi one-to-many antar resource.

#### Acceptance Criteria

1. WHEN klien mengirim request `GET /api/comments`, THE API_Server SHALL mengembalikan JSON_Response berisi daftar semua Comment dengan HTTP status 200.
2. WHEN klien mengirim request `GET /api/comments/{id}` dengan `id` yang ada, THE API_Server SHALL mengembalikan JSON_Response berisi data satu Comment beserta data Post terkait dengan HTTP status 200.
3. IF klien mengirim request `GET /api/comments/{id}` dengan `id` yang tidak ada, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan error dengan HTTP status 404.
4. WHEN klien mengirim request `GET /api/posts/{id}/comments` dengan `id` Post yang ada, THE API_Server SHALL mengembalikan JSON_Response berisi daftar semua Comment yang dimiliki Post tersebut dengan HTTP status 200.
5. IF klien mengirim request `GET /api/posts/{id}/comments` dengan `id` Post yang tidak ada, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan error dengan HTTP status 404.
6. WHEN klien mengirim request `POST /api/comments` dengan data `post_id`, `name`, `email`, `body`, dan `status` yang valid, THE API_Server SHALL menyimpan Comment baru dan mengembalikan JSON_Response berisi data Comment yang dibuat dengan HTTP status 201.
7. IF klien mengirim request `POST /api/comments` dengan `post_id` yang tidak merujuk ke Post yang ada, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan validasi dengan HTTP status 422.
8. IF klien mengirim request `POST /api/comments` dengan data yang tidak lengkap atau tidak valid, THEN THE API_Server SHALL mengembalikan JSON_Response berisi daftar pesan validasi dengan HTTP status 422.
9. WHEN klien mengirim request `PUT /api/comments/{id}` dengan `id` yang ada dan data yang valid, THE API_Server SHALL memperbarui Comment dan mengembalikan JSON_Response berisi data Comment yang diperbarui dengan HTTP status 200.
10. IF klien mengirim request `PUT /api/comments/{id}` dengan `id` yang tidak ada, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan error dengan HTTP status 404.
11. WHEN klien mengirim request `DELETE /api/comments/{id}` dengan `id` yang ada, THE API_Server SHALL menghapus Comment dan mengembalikan JSON_Response konfirmasi dengan HTTP status 200.
12. IF klien mengirim request `DELETE /api/comments/{id}` dengan `id` yang tidak ada, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan error dengan HTTP status 404.
13. THE API_Server SHALL memastikan setiap Comment selalu memiliki `post_id` yang merujuk ke Post yang ada (foreign key constraint).

---

### Requirement 4: CRUD User (API Terproteksi)

**User Story:** Sebagai administrator, saya ingin mengelola data User melalui API yang terproteksi, sehingga hanya pengguna yang sudah login yang dapat mengakses data pengguna.

#### Acceptance Criteria

1. WHILE Auth_Middleware aktif, THE API_Server SHALL memvalidasi Token pada setiap request ke endpoint `/api/users`.
2. WHEN pengguna terautentikasi mengirim request `GET /api/users`, THE API_Server SHALL mengembalikan JSON_Response berisi daftar semua User dengan HTTP status 200.
3. WHEN pengguna terautentikasi mengirim request `GET /api/users/{id}` dengan `id` yang ada, THE API_Server SHALL mengembalikan JSON_Response berisi data satu User dengan HTTP status 200.
4. IF pengguna terautentikasi mengirim request `GET /api/users/{id}` dengan `id` yang tidak ada, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan error dengan HTTP status 404.
5. WHEN pengguna terautentikasi mengirim request `POST /api/users` dengan data `name`, `email`, `password`, `role`, dan `is_active` yang valid, THE API_Server SHALL menyimpan User baru dan mengembalikan JSON_Response berisi data User (tanpa `password`) dengan HTTP status 201.
6. IF pengguna terautentikasi mengirim request `POST /api/users` dengan `email` yang sudah terdaftar, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan validasi dengan HTTP status 422.
7. WHEN pengguna terautentikasi mengirim request `PUT /api/users/{id}` dengan `id` yang ada dan data yang valid, THE API_Server SHALL memperbarui User dan mengembalikan JSON_Response berisi data User yang diperbarui (tanpa `password`) dengan HTTP status 200.
8. WHEN pengguna terautentikasi mengirim request `DELETE /api/users/{id}` dengan `id` yang ada, THE API_Server SHALL menghapus User dan mengembalikan JSON_Response konfirmasi dengan HTTP status 200.
9. THE API_Server SHALL memastikan field `password` tidak pernah disertakan dalam JSON_Response data User.

---

### Requirement 5: CRUD Pasien (API Terproteksi)

**User Story:** Sebagai tenaga medis, saya ingin mengelola data Pasien melalui API yang terproteksi, sehingga data pasien hanya dapat diakses oleh pengguna yang sudah login.

#### Acceptance Criteria

1. WHILE Auth_Middleware aktif, THE API_Server SHALL memvalidasi Token pada setiap request ke endpoint `/api/pasien`.
2. WHEN pengguna terautentikasi mengirim request `GET /api/pasien`, THE API_Server SHALL mengembalikan JSON_Response berisi daftar semua Pasien dengan HTTP status 200.
3. WHEN pengguna terautentikasi mengirim request `GET /api/pasien/{id}` dengan `id` yang ada, THE API_Server SHALL mengembalikan JSON_Response berisi data satu Pasien beserta daftar Penyakit yang didiagnosa dengan HTTP status 200.
4. IF pengguna terautentikasi mengirim request `GET /api/pasien/{id}` dengan `id` yang tidak ada, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan error dengan HTTP status 404.
5. WHEN pengguna terautentikasi mengirim request `POST /api/pasien` dengan data `nama`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, dan `no_telepon` yang valid, THE API_Server SHALL menyimpan Pasien baru dan mengembalikan JSON_Response berisi data Pasien yang dibuat dengan HTTP status 201.
6. IF pengguna terautentikasi mengirim request `POST /api/pasien` dengan data yang tidak lengkap atau tidak valid, THEN THE API_Server SHALL mengembalikan JSON_Response berisi daftar pesan validasi dengan HTTP status 422.
7. WHEN pengguna terautentikasi mengirim request `PUT /api/pasien/{id}` dengan `id` yang ada dan data yang valid, THE API_Server SHALL memperbarui Pasien dan mengembalikan JSON_Response berisi data Pasien yang diperbarui dengan HTTP status 200.
8. WHEN pengguna terautentikasi mengirim request `DELETE /api/pasien/{id}` dengan `id` yang ada, THE API_Server SHALL menghapus Pasien beserta semua data Diagnosa terkait dan mengembalikan JSON_Response konfirmasi dengan HTTP status 200.

---

### Requirement 6: CRUD Penyakit (API Terproteksi)

**User Story:** Sebagai tenaga medis, saya ingin mengelola data Penyakit melalui API yang terproteksi, sehingga data penyakit hanya dapat diakses oleh pengguna yang sudah login.

#### Acceptance Criteria

1. WHILE Auth_Middleware aktif, THE API_Server SHALL memvalidasi Token pada setiap request ke endpoint `/api/penyakit`.
2. WHEN pengguna terautentikasi mengirim request `GET /api/penyakit`, THE API_Server SHALL mengembalikan JSON_Response berisi daftar semua Penyakit dengan HTTP status 200.
3. WHEN pengguna terautentikasi mengirim request `GET /api/penyakit/{id}` dengan `id` yang ada, THE API_Server SHALL mengembalikan JSON_Response berisi data satu Penyakit beserta daftar Pasien yang didiagnosa dengan HTTP status 200.
4. IF pengguna terautentikasi mengirim request `GET /api/penyakit/{id}` dengan `id` yang tidak ada, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan error dengan HTTP status 404.
5. WHEN pengguna terautentikasi mengirim request `POST /api/penyakit` dengan data `nama`, `kode_icd`, `deskripsi`, `kategori`, dan `tingkat_keparahan` yang valid, THE API_Server SHALL menyimpan Penyakit baru dan mengembalikan JSON_Response berisi data Penyakit yang dibuat dengan HTTP status 201.
6. IF pengguna terautentikasi mengirim request `POST /api/penyakit` dengan `kode_icd` yang sudah terdaftar, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan validasi dengan HTTP status 422.
7. WHEN pengguna terautentikasi mengirim request `PUT /api/penyakit/{id}` dengan `id` yang ada dan data yang valid, THE API_Server SHALL memperbarui Penyakit dan mengembalikan JSON_Response berisi data Penyakit yang diperbarui dengan HTTP status 200.
8. WHEN pengguna terautentikasi mengirim request `DELETE /api/penyakit/{id}` dengan `id` yang ada, THE API_Server SHALL menghapus Penyakit beserta semua data Diagnosa terkait dan mengembalikan JSON_Response konfirmasi dengan HTTP status 200.

---

### Requirement 7: Manajemen Diagnosa (Relasi Pasien–Penyakit)

**User Story:** Sebagai tenaga medis, saya ingin menambah dan menghapus diagnosa pada seorang Pasien melalui API, sehingga saya bisa mencatat penyakit yang diderita pasien.

#### Acceptance Criteria

1. WHILE Auth_Middleware aktif, THE API_Server SHALL memvalidasi Token pada setiap request ke endpoint `/api/pasien/{id}/diagnosa`.
2. WHEN pengguna terautentikasi mengirim request `POST /api/pasien/{id}/diagnosa` dengan daftar `penyakit_id` yang valid, THE API_Server SHALL menambahkan relasi Diagnosa antara Pasien dan Penyakit yang ditentukan, lalu mengembalikan JSON_Response berisi data Pasien beserta daftar Penyakit terbaru dengan HTTP status 200.
3. IF pengguna terautentikasi mengirim request `POST /api/pasien/{id}/diagnosa` dengan `penyakit_id` yang tidak ada, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan validasi dengan HTTP status 422.
4. WHEN pengguna terautentikasi mengirim request `DELETE /api/pasien/{id}/diagnosa/{penyakit_id}` dengan `id` Pasien dan `penyakit_id` yang ada, THE API_Server SHALL menghapus relasi Diagnosa tersebut dan mengembalikan JSON_Response konfirmasi dengan HTTP status 200.
5. IF pengguna terautentikasi mengirim request `DELETE /api/pasien/{id}/diagnosa/{penyakit_id}` dengan relasi yang tidak ada, THEN THE API_Server SHALL mengembalikan JSON_Response berisi pesan error dengan HTTP status 404.
6. THE API_Server SHALL memastikan satu Pasien tidak dapat memiliki entri Diagnosa duplikat untuk Penyakit yang sama.

---

### Requirement 8: Format Respons API yang Konsisten

**User Story:** Sebagai developer klien, saya ingin semua respons API memiliki format JSON yang konsisten, sehingga saya bisa memproses respons dengan cara yang seragam di semua endpoint.

#### Acceptance Criteria

1. THE API_Server SHALL mengembalikan semua respons API dalam format JSON dengan header `Content-Type: application/json`.
2. WHEN operasi berhasil, THE API_Server SHALL mengembalikan JSON_Response dengan struktur: `{"success": true, "message": "...", "data": {...}}`.
3. WHEN operasi gagal, THE API_Server SHALL mengembalikan JSON_Response dengan struktur: `{"success": false, "message": "...", "errors": {...}}`.
4. THE API_Server SHALL menyertakan HTTP status code yang sesuai pada setiap respons (200, 201, 401, 404, 422).

---

### Requirement 9: Halaman Dokumentasi API (Blade + Bootstrap)

**User Story:** Sebagai developer klien, saya ingin mengakses halaman dokumentasi API melalui browser, sehingga saya bisa memahami cara menggunakan setiap endpoint tanpa membaca kode sumber.

#### Acceptance Criteria

1. THE API_Server SHALL menyediakan halaman dokumentasi yang dapat diakses melalui browser di URL `/docs`.
2. THE Blade_View SHALL menampilkan daftar semua endpoint API beserta method HTTP, URL, parameter yang diperlukan, dan contoh respons JSON.
3. THE Blade_View SHALL membedakan secara visual antara endpoint Public_API dan endpoint Protected_API.
4. THE Blade_View SHALL menampilkan contoh request header `Authorization: Bearer {token}` untuk setiap endpoint Protected_API.
5. THE Blade_View SHALL menggunakan Bootstrap untuk styling sehingga halaman responsif dan mudah dibaca.
6. WHEN pengguna mengakses `/docs` melalui browser, THE API_Server SHALL merender halaman dokumentasi menggunakan Blade_View dengan HTTP status 200.
