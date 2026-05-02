# Implementation Plan: Laravel API Learning

## Overview

Implementasi RESTful API Laravel dengan dua kelompok endpoint (publik dan terproteksi Sanctum), halaman dokumentasi Blade + Bootstrap, dan pengujian menggunakan PHPUnit feature tests. Urutan task mengikuti dependency order: setup → database → models → validasi → resources → error handling → controllers → routes → views → seeder → tests.

## Tasks

- [x] 1. Setup awal: install Sanctum
  - Jalankan `composer require laravel/sanctum` untuk menginstall Sanctum
  - Publish konfigurasi Sanctum: `php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"`
  - Tambahkan kolom `role` (varchar 50, default 'user') dan `is_active` (boolean, default true) ke migrasi users yang sudah ada (`0001_01_01_000000_create_users_table.php`)
  - _Requirements: 1.5, 4.5_

- [x] 2. Buat migrations untuk semua tabel baru
  - [x] 2.1 Buat migration `create_posts_table`
    - Kolom: `title` (varchar 255, NOT NULL), `body` (text, NOT NULL), `author` (varchar 255, NOT NULL), `slug` (varchar 255, NOT NULL, UNIQUE), `status` (varchar 50, NOT NULL, default 'draft')
    - _Requirements: 2.4, 2.10_

  - [x] 2.2 Buat migration `create_comments_table`
    - Kolom: `post_id` (FK→posts ON DELETE CASCADE), `name` (varchar 255, NOT NULL), `email` (varchar 255, NOT NULL), `body` (text, NOT NULL), `status` (varchar 50, NOT NULL, default 'pending')
    - _Requirements: 3.6, 3.13_

  - [x] 2.3 Buat migration `create_pasien_table`
    - Kolom: `nama` (varchar 255, NOT NULL), `tanggal_lahir` (date, NOT NULL), `jenis_kelamin` (char 1, NOT NULL), `alamat` (text, NOT NULL), `no_telepon` (varchar 20, NOT NULL)
    - _Requirements: 5.5_

  - [x] 2.4 Buat migration `create_penyakit_table`
    - Kolom: `kode_icd` (varchar 20, NOT NULL, UNIQUE), `nama` (varchar 255, NOT NULL), `deskripsi` (text, nullable), `kategori` (varchar 100, NOT NULL)
    - _Requirements: 6.5, 6.6_

  - [x] 2.5 Buat migration `create_diagnosa_table`
    - Kolom: `pasien_id` (FK→pasien ON DELETE CASCADE), `penyakit_id` (FK→penyakit ON DELETE CASCADE)
    - Tambahkan unique constraint pada kombinasi `(pasien_id, penyakit_id)`
    - _Requirements: 7.6_

- [x] 3. Buat Eloquent Models dengan relasi
  - [x] 3.1 Update model `User` — tambahkan `HasApiTokens`, fillable `role` dan `is_active`, hidden `password`, cast `is_active` ke boolean dan `password` ke hashed
    - _Requirements: 1.5, 4.9_

  - [x] 3.2 Buat model `Post` dengan fillable dan relasi `hasMany(Comment::class)`
    - _Requirements: 2.4, 2.11_

  - [x] 3.3 Buat model `Comment` dengan fillable dan relasi `belongsTo(Post::class)`
    - _Requirements: 3.2, 3.13_

  - [x] 3.4 Buat model `Pasien` dengan fillable dan relasi `belongsToMany(Penyakit::class, 'diagnosa')`
    - _Requirements: 5.3, 7.2_

  - [x] 3.5 Buat model `Penyakit` dengan fillable dan relasi `belongsToMany(Pasien::class, 'diagnosa')`
    - _Requirements: 6.3, 7.2_

- [x] 4. Buat Form Requests untuk validasi input
  - [x] 4.1 Buat `StorePostRequest` dan `UpdatePostRequest`
    - `StorePostRequest`: wajib `title`, `body`, `author`, `slug` (unique:posts), `status`
    - `UpdatePostRequest`: sama dengan Store tapi `slug` unique mengabaikan record saat ini
    - Override `failedValidation` di keduanya untuk mengembalikan format `{"success": false, "message": "Data tidak valid", "errors": {...}}` dengan status 422
    - _Requirements: 2.5, 2.10, 8.3_

  - [x] 4.2 Buat `StoreCommentRequest` dan `UpdateCommentRequest`
    - `StoreCommentRequest`: wajib `post_id` (exists:posts,id), `name`, `email`, `body`, `status`
    - `UpdateCommentRequest`: wajib `name`, `email`, `body`, `status`
    - Override `failedValidation` di keduanya
    - _Requirements: 3.7, 3.8, 8.3_

  - [x] 4.3 Buat `StoreUserRequest` dan `UpdateUserRequest`
    - `StoreUserRequest`: wajib `name`, `email` (unique:users), `password` (min:8), `role`, `is_active`
    - `UpdateUserRequest`: sama dengan Store tapi `email` unique mengabaikan record saat ini, `password` opsional
    - Override `failedValidation` di keduanya
    - _Requirements: 4.5, 4.6, 8.3_

  - [x] 4.4 Buat `StorePasienRequest` dan `UpdatePasienRequest`
    - `StorePasienRequest`: wajib `nama`, `tanggal_lahir` (date), `jenis_kelamin` (in:L,P), `alamat`, `no_telepon`
    - `UpdatePasienRequest`: sama dengan Store
    - Override `failedValidation` di keduanya
    - _Requirements: 5.5, 5.6, 8.3_

  - [x] 4.5 Buat `StorePenyakitRequest` dan `UpdatePenyakitRequest`
    - `StorePenyakitRequest`: wajib `kode_icd` (unique:penyakit), `nama`, `kategori`; opsional `deskripsi`
    - `UpdatePenyakitRequest`: sama dengan Store tapi `kode_icd` unique mengabaikan record saat ini
    - Override `failedValidation` di keduanya
    - _Requirements: 6.5, 6.6, 8.3_

  - [x] 4.6 Buat `StoreDiagnosaRequest`
    - Wajib `penyakit_id` (array, setiap elemen exists:penyakit,id)
    - Override `failedValidation`
    - _Requirements: 7.2, 7.3, 8.3_

- [x] 5. Buat API Resources untuk transformasi JSON
  - [x] 5.1 Buat `UserResource` — expose semua field kecuali `password` dan `remember_token`
    - _Requirements: 4.9, 8.2_

  - [x] 5.2 Buat `PostResource` — expose semua field; sertakan relasi `comments` (sebagai `CommentResource::collection`) hanya jika sudah di-load
    - _Requirements: 2.11, 8.2_

  - [x] 5.3 Buat `CommentResource` — expose semua field; sertakan relasi `post` (sebagai `PostResource`) hanya jika sudah di-load
    - _Requirements: 3.2, 8.2_

  - [x] 5.4 Buat `PasienResource` — expose semua field; sertakan relasi `penyakit` (sebagai `PenyakitResource::collection`) hanya jika sudah di-load
    - _Requirements: 5.3, 8.2_

  - [x] 5.5 Buat `PenyakitResource` — expose semua field; sertakan relasi `pasien` (sebagai `PasienResource::collection`) hanya jika sudah di-load
    - _Requirements: 6.3, 8.2_

- [x] 6. Konfigurasi Exception Handler terpusat
  - Edit `bootstrap/app.php` untuk menambahkan handler `ModelNotFoundException` → 404 JSON, `AuthenticationException` → 401 JSON, dan `ValidationException` fallback → 422 JSON
  - Setiap handler hanya aktif untuk request ke `api/*` (cek `$request->is('api/*')`)
  - Format respons error: `{"success": false, "message": "...", "errors": {}}`
  - _Requirements: 1.4, 2.3, 2.7, 2.9, 3.3, 3.5, 3.10, 3.12, 4.4, 5.4, 6.4, 8.3, 8.4_

- [ ] 7. Buat Controllers
  - [x] 7.1 Buat `AuthController` dengan method `login` dan `logout`
    - `login`: validasi email+password, gunakan `Auth::attempt`, terbitkan token Sanctum, kembalikan `{"success": true, "message": "Login berhasil", "data": {"token": "...", "user": UserResource}}`; jika gagal kembalikan 401
    - `logout`: cabut token saat ini via `$request->user()->currentAccessToken()->delete()`, kembalikan 200
    - _Requirements: 1.1, 1.2, 1.3_

  - [x] 7.2 Buat `PostController` dengan method `index`, `show`, `store`, `update`, `destroy`
    - `index`: kembalikan semua post via `PostResource::collection`
    - `show`: load relasi `comments`, kembalikan `PostResource` (dengan comments)
    - `store`: gunakan `StorePostRequest`, simpan, kembalikan 201
    - `update`: gunakan `UpdatePostRequest`, update, kembalikan 200
    - `destroy`: hapus post (cascade ke comments otomatis via FK), kembalikan 200
    - _Requirements: 2.1–2.9, 2.11_

  - [x] 7.3 Buat `CommentController` dengan method `index`, `show`, `store`, `update`, `destroy`, dan `byPost`
    - `index`: kembalikan semua comment via `CommentResource::collection`
    - `show`: load relasi `post`, kembalikan `CommentResource` (dengan post)
    - `byPost`: cari post by id (throw 404 jika tidak ada), kembalikan comments milik post tersebut
    - `store`: gunakan `StoreCommentRequest`, simpan, kembalikan 201
    - `update`: gunakan `UpdateCommentRequest`, update, kembalikan 200
    - `destroy`: hapus comment, kembalikan 200
    - _Requirements: 3.1–3.12_

  - [x] 7.4 Buat `UserController` dengan method `index`, `show`, `store`, `update`, `destroy`
    - Semua method dilindungi `auth:sanctum` middleware (diterapkan di route)
    - `store`: gunakan `StoreUserRequest`, hash password, simpan, kembalikan `UserResource` 201
    - `update`: gunakan `UpdateUserRequest`, hash password jika ada, update, kembalikan 200
    - Semua response menggunakan `UserResource` (tanpa password)
    - _Requirements: 4.1–4.9_

  - [x] 7.5 Buat `PasienController` dengan method `index`, `show`, `store`, `update`, `destroy`
    - `show`: load relasi `penyakit`, kembalikan `PasienResource` (dengan penyakit)
    - `destroy`: hapus pasien (cascade ke diagnosa otomatis via FK), kembalikan 200
    - _Requirements: 5.1–5.8_

  - [x] 7.6 Buat `PenyakitController` dengan method `index`, `show`, `store`, `update`, `destroy`
    - `show`: load relasi `pasien`, kembalikan `PenyakitResource` (dengan pasien)
    - `destroy`: hapus penyakit (cascade ke diagnosa otomatis via FK), kembalikan 200
    - _Requirements: 6.1–6.8_

  - [x] 7.7 Buat `DiagnosaController` dengan method `store` dan `destroy`
    - `store`: gunakan `StoreDiagnosaRequest`, gunakan `syncWithoutDetaching` untuk menambah diagnosa tanpa duplikasi, load ulang relasi `penyakit`, kembalikan `PasienResource` 200
    - `destroy`: cari relasi diagnosa, jika tidak ada kembalikan 404, hapus via `detach`, kembalikan 200
    - _Requirements: 7.1–7.6_

  - [x] 7.8 Buat `DocsController` dengan method `index`
    - Kembalikan view `docs.index` dengan status 200
    - _Requirements: 9.1, 9.6_

- [x] 8. Konfigurasi Routes
  - [x] 8.1 Tulis `routes/api.php`
    - Route publik: `POST /login` → `AuthController@login`
    - Route terproteksi (group `auth:sanctum`): `POST /logout`, semua resource `/users`, `/pasien`, `/penyakit`, `/penyakit`
    - Route publik resource: `/posts` (index, show, store, update, destroy), `/comments` (index, show, store, update, destroy)
    - Route nested: `GET /posts/{id}/comments` → `CommentController@byPost`
    - Route diagnosa (group `auth:sanctum`): `POST /pasien/{pasien}/diagnosa`, `DELETE /pasien/{pasien}/diagnosa/{penyakit}`
    - _Requirements: 1.1, 1.3, 2.1, 3.1, 3.4, 4.1, 5.1, 6.1, 7.1_

  - [x] 8.2 Tulis `routes/web.php`
    - Tambahkan route `GET /docs` → `DocsController@index`
    - _Requirements: 9.1, 9.6_

- [x] 9. Buat Blade Views untuk halaman dokumentasi `/docs`
  - [x] 9.1 Buat `resources/views/docs/index.blade.php`
    - Layout utama dengan Bootstrap 5 CDN, navbar, sidebar navigasi, dan `@include` untuk setiap partial
    - Sidebar berisi link anchor ke setiap section (auth, posts, comments, users, pasien, penyakit, diagnosa)
    - _Requirements: 9.1, 9.5, 9.6_

  - [x] 9.2 Buat `resources/views/docs/partials/auth.blade.php`
    - Dokumentasi `POST /api/login` dan `POST /api/logout`
    - Tampilkan badge PUBLIC/PROTECTED, method badge, URL, contoh request body, contoh response JSON
    - _Requirements: 9.2, 9.3, 9.4_

  - [x] 9.3 Buat `resources/views/docs/partials/posts.blade.php`
    - Dokumentasi semua 5 endpoint Post (GET index, GET show, POST store, PUT update, DELETE destroy)
    - Badge PUBLIC untuk semua endpoint Post
    - _Requirements: 9.2, 9.3_

  - [x] 9.4 Buat `resources/views/docs/partials/comments.blade.php`
    - Dokumentasi semua 6 endpoint Comment termasuk `GET /api/posts/{id}/comments`
    - Badge PUBLIC untuk semua endpoint Comment
    - _Requirements: 9.2, 9.3_

  - [x] 9.5 Buat `resources/views/docs/partials/users.blade.php`
    - Dokumentasi semua 5 endpoint User
    - Badge PROTECTED + tampilkan header `Authorization: Bearer {token}` untuk setiap endpoint
    - _Requirements: 9.2, 9.3, 9.4_

  - [x] 9.6 Buat `resources/views/docs/partials/pasien.blade.php`
    - Dokumentasi semua 5 endpoint Pasien
    - Badge PROTECTED + header Authorization
    - _Requirements: 9.2, 9.3, 9.4_

  - [x] 9.7 Buat `resources/views/docs/partials/penyakit.blade.php`
    - Dokumentasi semua 5 endpoint Penyakit
    - Badge PROTECTED + header Authorization
    - _Requirements: 9.2, 9.3, 9.4_

  - [x] 9.8 Buat `resources/views/docs/partials/diagnosa.blade.php`
    - Dokumentasi 2 endpoint Diagnosa (`POST` dan `DELETE`)
    - Badge PROTECTED + header Authorization + contoh request body `{"penyakit_id": [1, 2]}`
    - _Requirements: 9.2, 9.3, 9.4_

- [x] 10. Buat Seeder untuk data awal
  - Edit `database/seeders/DatabaseSeeder.php` untuk membuat satu user admin: `name: "Admin"`, `email: "admin@example.com"`, `password: bcrypt("password")`, `role: "admin"`, `is_active: true`
  - _Requirements: 1.1_

- [ ] 11. Checkpoint — Jalankan migrasi dan seeder, pastikan semua berjalan
  - Jalankan `php artisan migrate:fresh --seed` dan pastikan tidak ada error
  - Pastikan semua tests yang ada masih lulus: `php artisan test`
  - Tanyakan kepada user jika ada pertanyaan sebelum melanjutkan ke tests.

- [ ] 12. Tulis Feature Tests (contoh spesifik)
  - [ ] 12.1 Tulis `tests/Feature/AuthTest.php`
    - Test login berhasil dengan kredensial valid → 200, ada field `token` di response (Req 1.1)
    - Test login gagal dengan password salah → 401, `success: false` (Req 1.2)
    - Test logout berhasil → 200 (Req 1.3)
    - Test akses endpoint terproteksi tanpa token → 401 (Req 1.4)
    - _Requirements: 1.1, 1.2, 1.3, 1.4_

  - [ ] 12.2 Tulis `tests/Feature/PostTest.php`
    - Test GET `/api/posts` → 200, array data (Req 2.1)
    - Test GET `/api/posts/{id}` yang ada → 200, ada field `comments` (Req 2.2, 2.11)
    - Test GET `/api/posts/{id}` yang tidak ada → 404 (Req 2.3)
    - Test POST `/api/posts` dengan data valid → 201 (Req 2.4)
    - Test POST `/api/posts` dengan data tidak valid → 422, ada field `errors` (Req 2.5)
    - Test DELETE `/api/posts/{id}` → 200, comments terkait terhapus (Req 2.8)
    - _Requirements: 2.1–2.9, 2.11_

  - [ ] 12.3 Tulis `tests/Feature/CommentTest.php`
    - Test GET `/api/comments/{id}` → 200, ada field `post` (Req 3.2)
    - Test GET `/api/posts/{id}/comments` → 200 (Req 3.4)
    - Test GET `/api/posts/{id}/comments` dengan post tidak ada → 404 (Req 3.5)
    - Test POST `/api/comments` dengan `post_id` tidak valid → 422 (Req 3.7)
    - _Requirements: 3.1–3.12_

  - [ ] 12.4 Tulis `tests/Feature/UserTest.php`
    - Test GET `/api/users` tanpa token → 401 (Req 4.1)
    - Test POST `/api/users` dengan token valid → 201, tidak ada field `password` di response (Req 4.5, 4.9)
    - Test POST `/api/users` dengan email duplikat → 422 (Req 4.6)
    - _Requirements: 4.1–4.9_

  - [ ] 12.5 Tulis `tests/Feature/PasienPenyakitTest.php`
    - Test GET `/api/pasien/{id}` → 200, ada field `penyakit` (Req 5.3)
    - Test GET `/api/penyakit/{id}` → 200, ada field `pasien` (Req 6.3)
    - Test POST `/api/pasien/{id}/diagnosa` → 200, data pasien dengan penyakit terbaru (Req 7.2)
    - Test DELETE `/api/pasien/{id}/diagnosa/{penyakit_id}` dengan relasi tidak ada → 404 (Req 7.5)
    - _Requirements: 5.1–5.8, 6.1–6.8, 7.1–7.6_

  - [ ] 12.6 Tulis `tests/Feature/DocsTest.php`
    - Test GET `/docs` → 200, response berisi HTML (Req 9.1, 9.6)
    - _Requirements: 9.1, 9.6_

- [ ] 13. Final Checkpoint — Pastikan semua tests lulus
  - Jalankan `php artisan test` dan pastikan semua feature tests lulus
  - Tanyakan kepada user jika ada pertanyaan atau penyesuaian yang diperlukan.

## Notes

- Setiap task mereferensikan requirements spesifik untuk keterlacakan
- Urutan task mengikuti dependency order: setup → DB → models → validasi → resources → error handling → controllers → routes → views → seeder → tests
- Exception Handler terpusat di `bootstrap/app.php` memastikan format respons error yang konsisten di semua endpoint
- Kolom `email_verified_at` dan `remember_token` dari migrasi default Laravel tetap ada namun tidak diekspos di API
- Tabel `diagnosa` menggunakan unique constraint `(pasien_id, penyakit_id)` untuk mencegah duplikasi; gunakan `syncWithoutDetaching` di controller
