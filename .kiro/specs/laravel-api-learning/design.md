# Design Document: Laravel API Learning

## Overview

Aplikasi ini adalah proyek Laravel untuk latihan membangun RESTful API. Sistem terdiri dari dua kelompok endpoint: **API Publik** (Post & Comment, tanpa autentikasi) dan **API Terproteksi** (User, Pasien, Penyakit, Diagnosa — memerlukan token Sanctum). Selain endpoint API, tersedia halaman dokumentasi berbasis Blade + Bootstrap di `/docs`.

Tujuan utama desain adalah kesederhanaan dan keterbacaan kode — cocok sebagai referensi belajar. Setiap tabel dibatasi maksimal 5 kolom data (tidak termasuk `id` dan `timestamps`).

---

## Architecture

### Gambaran Umum

```
Client (Mobile / Python / Browser)
        │
        ▼
┌─────────────────────────────────────────┐
│           Laravel Application           │
│                                         │
│  routes/api.php  ──►  API Controllers   │
│  routes/web.php  ──►  DocsController    │
│                                         │
│  Middleware: auth:sanctum (Protected)   │
│                                         │
│  Models: User, Post, Comment,           │
│          Pasien, Penyakit               │
│                                         │
│  Resources: JSON API Resources          │
│                                         │
│  Views: Blade (docs only)               │
└─────────────────────────────────────────┘
        │
        ▼
   MySQL Database
```

### Struktur Folder Laravel

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── PostController.php
│   │   ├── CommentController.php
│   │   ├── UserController.php
│   │   ├── PasienController.php
│   │   ├── PenyakitController.php
│   │   ├── DiagnosaController.php
│   │   └── DocsController.php
│   ├── Requests/
│   │   ├── StorePostRequest.php
│   │   ├── UpdatePostRequest.php
│   │   ├── StoreCommentRequest.php
│   │   ├── UpdateCommentRequest.php
│   │   ├── StoreUserRequest.php
│   │   ├── UpdateUserRequest.php
│   │   ├── StorePasienRequest.php
│   │   ├── UpdatePasienRequest.php
│   │   ├── StorePenyakitRequest.php
│   │   ├── UpdatePenyakitRequest.php
│   │   └── StoreDiagnosaRequest.php
│   └── Resources/
│       ├── PostResource.php
│       ├── CommentResource.php
│       ├── UserResource.php
│       ├── PasienResource.php
│       └── PenyakitResource.php
├── Models/
│   ├── User.php
│   ├── Post.php
│   ├── Comment.php
│   ├── Pasien.php
│   └── Penyakit.php
database/
├── migrations/
│   ├── ..._create_users_table.php        (sudah ada)
│   ├── ..._create_posts_table.php
│   ├── ..._create_comments_table.php
│   ├── ..._create_pasien_table.php
│   ├── ..._create_penyakit_table.php
│   └── ..._create_diagnosa_table.php
routes/
├── api.php
└── web.php
resources/
└── views/
    └── docs/
        ├── index.blade.php
        └── partials/
            ├── auth.blade.php
            ├── posts.blade.php
            ├── comments.blade.php
            ├── users.blade.php
            ├── pasien.blade.php
            ├── penyakit.blade.php
            └── diagnosa.blade.php
```

### Komponen Utama

| Komponen | Tanggung Jawab |
|---|---|
| `AuthController` | Login (terbitkan token Sanctum), Logout (cabut token) |
| `PostController` | CRUD Post — publik |
| `CommentController` | CRUD Comment — publik |
| `UserController` | CRUD User — terproteksi |
| `PasienController` | CRUD Pasien — terproteksi |
| `PenyakitController` | CRUD Penyakit — terproteksi |
| `DiagnosaController` | Tambah/hapus relasi Pasien↔Penyakit — terproteksi |
| `DocsController` | Render halaman dokumentasi Blade |
| Form Requests | Validasi input per endpoint |
| API Resources | Transformasi model ke JSON yang konsisten |
| `auth:sanctum` middleware | Proteksi endpoint terproteksi |

---

## Components and Interfaces

### API Endpoints

#### Autentikasi (Publik)

| Method | URL | Deskripsi | Auth |
|---|---|---|---|
| POST | `/api/login` | Login, terima token | ❌ |
| POST | `/api/logout` | Logout, cabut token | ✅ |

#### Post (Publik)

| Method | URL | Deskripsi | Auth |
|---|---|---|---|
| GET | `/api/posts` | Daftar semua post | ❌ |
| GET | `/api/posts/{id}` | Detail post + comments | ❌ |
| POST | `/api/posts` | Buat post baru | ❌ |
| PUT | `/api/posts/{id}` | Update post | ❌ |
| DELETE | `/api/posts/{id}` | Hapus post + comments | ❌ |

#### Comment (Publik)

| Method | URL | Deskripsi | Auth |
|---|---|---|---|
| GET | `/api/comments` | Daftar semua comment | ❌ |
| GET | `/api/comments/{id}` | Detail comment + post | ❌ |
| GET | `/api/posts/{id}/comments` | Comments milik post | ❌ |
| POST | `/api/comments` | Buat comment baru | ❌ |
| PUT | `/api/comments/{id}` | Update comment | ❌ |
| DELETE | `/api/comments/{id}` | Hapus comment | ❌ |

#### User (Terproteksi)

| Method | URL | Deskripsi | Auth |
|---|---|---|---|
| GET | `/api/users` | Daftar semua user | ✅ |
| GET | `/api/users/{id}` | Detail user | ✅ |
| POST | `/api/users` | Buat user baru | ✅ |
| PUT | `/api/users/{id}` | Update user | ✅ |
| DELETE | `/api/users/{id}` | Hapus user | ✅ |

#### Pasien (Terproteksi)

| Method | URL | Deskripsi | Auth |
|---|---|---|---|
| GET | `/api/pasien` | Daftar semua pasien | ✅ |
| GET | `/api/pasien/{id}` | Detail pasien + diagnosa | ✅ |
| POST | `/api/pasien` | Buat pasien baru | ✅ |
| PUT | `/api/pasien/{id}` | Update pasien | ✅ |
| DELETE | `/api/pasien/{id}` | Hapus pasien + diagnosa | ✅ |

#### Penyakit (Terproteksi)

| Method | URL | Deskripsi | Auth |
|---|---|---|---|
| GET | `/api/penyakit` | Daftar semua penyakit | ✅ |
| GET | `/api/penyakit/{id}` | Detail penyakit + pasien | ✅ |
| POST | `/api/penyakit` | Buat penyakit baru | ✅ |
| PUT | `/api/penyakit/{id}` | Update penyakit | ✅ |
| DELETE | `/api/penyakit/{id}` | Hapus penyakit + diagnosa | ✅ |

#### Diagnosa (Terproteksi)

| Method | URL | Deskripsi | Auth |
|---|---|---|---|
| POST | `/api/pasien/{id}/diagnosa` | Tambah diagnosa ke pasien | ✅ |
| DELETE | `/api/pasien/{id}/diagnosa/{penyakit_id}` | Hapus diagnosa dari pasien | ✅ |

#### Dokumentasi

| Method | URL | Deskripsi |
|---|---|---|
| GET | `/docs` | Halaman dokumentasi API |

### Request & Response Contracts

#### POST /api/login
```json
// Request Body
{
  "email": "admin@example.com",
  "password": "secret"
}

// Response 200
{
  "success": true,
  "message": "Login berhasil",
  "data": {
    "token": "1|abc123...",
    "user": {
      "id": 1,
      "name": "Admin",
      "email": "admin@example.com",
      "role": "admin",
      "is_active": true
    }
  }
}

// Response 401
{
  "success": false,
  "message": "Email atau password salah",
  "errors": {}
}
```

#### POST /api/posts
```json
// Request Body
{
  "title": "Judul Post",
  "body": "Isi konten post...",
  "author": "Nama Penulis",
  "slug": "judul-post",
  "status": "published"
}

// Response 201
{
  "success": true,
  "message": "Post berhasil dibuat",
  "data": {
    "id": 1,
    "title": "Judul Post",
    "body": "Isi konten post...",
    "author": "Nama Penulis",
    "slug": "judul-post",
    "status": "published",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}
```

#### GET /api/posts/{id}
```json
// Response 200
{
  "success": true,
  "message": "Data post ditemukan",
  "data": {
    "id": 1,
    "title": "Judul Post",
    "body": "Isi konten post...",
    "author": "Nama Penulis",
    "slug": "judul-post",
    "status": "published",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z",
    "comments": [
      {
        "id": 1,
        "post_id": 1,
        "name": "Komentator",
        "email": "komentar@example.com",
        "body": "Isi komentar",
        "status": "approved",
        "created_at": "2024-01-01T00:00:00.000000Z",
        "updated_at": "2024-01-01T00:00:00.000000Z"
      }
    ]
  }
}
```

#### POST /api/pasien/{id}/diagnosa
```json
// Request Body
{
  "penyakit_id": [1, 2, 3]
}

// Response 200
{
  "success": true,
  "message": "Diagnosa berhasil ditambahkan",
  "data": {
    "id": 1,
    "nama": "Budi Santoso",
    "tanggal_lahir": "1990-05-15",
    "jenis_kelamin": "L",
    "alamat": "Jl. Merdeka No. 1",
    "no_telepon": "081234567890",
    "penyakit": [
      {
        "id": 1,
        "kode_icd": "A00",
        "nama": "Kolera",
        "deskripsi": "...",
        "kategori": "Infeksi"
      }
    ]
  }
}
```

#### Response Error Umum
```json
// 404 Not Found
{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}

// 422 Unprocessable Entity
{
  "success": false,
  "message": "Data tidak valid",
  "errors": {
    "title": ["The title field is required."],
    "slug": ["The slug has already been taken."]
  }
}

// 401 Unauthorized
{
  "success": false,
  "message": "Unauthenticated",
  "errors": {}
}
```

---

## Data Models

### Entity Relationship Diagram

```
users
  id, name, email, password, role, is_active

posts
  id, title, body, author, slug, status
  └── has many comments

comments
  id, post_id (FK→posts), name, email, body, status

pasien
  id, nama, tanggal_lahir, jenis_kelamin, alamat, no_telepon
  └── belongs to many penyakit (via diagnosa)

penyakit
  id, kode_icd, nama, deskripsi, kategori
  └── belongs to many pasien (via diagnosa)

diagnosa (pivot)
  id, pasien_id (FK→pasien), penyakit_id (FK→penyakit)
```

### Skema Tabel

#### Tabel `users`
| Kolom | Tipe | Constraint |
|---|---|---|
| id | bigint unsigned | PK, auto increment |
| name | varchar(255) | NOT NULL |
| email | varchar(255) | NOT NULL, UNIQUE |
| password | varchar(255) | NOT NULL |
| role | varchar(50) | NOT NULL, default: 'user' |
| is_active | boolean | NOT NULL, default: true |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

> Kolom `email_verified_at` dan `remember_token` dari migrasi default Laravel tetap ada namun tidak diekspos di API.

#### Tabel `posts`
| Kolom | Tipe | Constraint |
|---|---|---|
| id | bigint unsigned | PK, auto increment |
| title | varchar(255) | NOT NULL |
| body | text | NOT NULL |
| author | varchar(255) | NOT NULL |
| slug | varchar(255) | NOT NULL, UNIQUE |
| status | varchar(50) | NOT NULL, default: 'draft' |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

#### Tabel `comments`
| Kolom | Tipe | Constraint |
|---|---|---|
| id | bigint unsigned | PK, auto increment |
| post_id | bigint unsigned | NOT NULL, FK→posts(id) ON DELETE CASCADE |
| name | varchar(255) | NOT NULL |
| email | varchar(255) | NOT NULL |
| body | text | NOT NULL |
| status | varchar(50) | NOT NULL, default: 'pending' |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

> `post_id` adalah foreign key — tidak dihitung sebagai kolom data karena merupakan relasi struktural.

#### Tabel `pasien`
| Kolom | Tipe | Constraint |
|---|---|---|
| id | bigint unsigned | PK, auto increment |
| nama | varchar(255) | NOT NULL |
| tanggal_lahir | date | NOT NULL |
| jenis_kelamin | char(1) | NOT NULL (nilai: 'L' atau 'P') |
| alamat | text | NOT NULL |
| no_telepon | varchar(20) | NOT NULL |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

#### Tabel `penyakit`
| Kolom | Tipe | Constraint |
|---|---|---|
| id | bigint unsigned | PK, auto increment |
| kode_icd | varchar(20) | NOT NULL, UNIQUE |
| nama | varchar(255) | NOT NULL |
| deskripsi | text | nullable |
| kategori | varchar(100) | NOT NULL |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

> Kolom `tingkat_keparahan` dari requirements Req 6.5 tidak dimasukkan karena sudah ada 4 kolom data (`kode_icd`, `nama`, `deskripsi`, `kategori`) dan batas maksimal adalah 5. Jika diperlukan, `tingkat_keparahan` dapat menggantikan `deskripsi`.

#### Tabel `diagnosa` (Pivot)
| Kolom | Tipe | Constraint |
|---|---|---|
| id | bigint unsigned | PK, auto increment |
| pasien_id | bigint unsigned | NOT NULL, FK→pasien(id) ON DELETE CASCADE |
| penyakit_id | bigint unsigned | NOT NULL, FK→penyakit(id) ON DELETE CASCADE |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

> Unique constraint pada kombinasi `(pasien_id, penyakit_id)` untuk mencegah duplikasi diagnosa.

### Eloquent Models dan Relasi

#### Model `User`
```php
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'is_active'];
    protected $hidden   = ['password', 'remember_token'];
    protected $casts    = ['password' => 'hashed', 'is_active' => 'boolean'];
}
```

#### Model `Post`
```php
class Post extends Model
{
    protected $fillable = ['title', 'body', 'author', 'slug', 'status'];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
```

#### Model `Comment`
```php
class Comment extends Model
{
    protected $fillable = ['post_id', 'name', 'email', 'body', 'status'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
```

#### Model `Pasien`
```php
class Pasien extends Model
{
    protected $fillable = ['nama', 'tanggal_lahir', 'jenis_kelamin', 'alamat', 'no_telepon'];

    public function penyakit(): BelongsToMany
    {
        return $this->belongsToMany(Penyakit::class, 'diagnosa');
    }
}
```

#### Model `Penyakit`
```php
class Penyakit extends Model
{
    protected $fillable = ['kode_icd', 'nama', 'deskripsi', 'kategori'];

    public function pasien(): BelongsToMany
    {
        return $this->belongsToMany(Pasien::class, 'diagnosa');
    }
}
```

### Diagram Relasi

```
┌──────────┐       ┌──────────┐
│  posts   │──────<│ comments │
└──────────┘  1:N  └──────────┘

┌──────────┐       ┌──────────┐       ┌──────────┐
│  pasien  │>─────<│ diagnosa │>─────<│ penyakit │
└──────────┘  N:M  └──────────┘  N:M  └──────────┘
```

---

## Correctness Properties

*A property is a characteristic or behavior that should hold true across all valid executions of a system — essentially, a formal statement about what the system should do. Properties serve as the bridge between human-readable specifications and machine-verifiable correctness guarantees.*


### Property 1: Kredensial tidak valid selalu ditolak

*For any* kombinasi email dan password yang tidak cocok dengan data user yang ada di database, request `POST /api/login` SHALL mengembalikan HTTP status 401 dengan `success: false`.

**Validates: Requirements 1.2**

---

### Property 2: Token dicabut setelah logout

*For any* token Sanctum yang valid, setelah request `POST /api/logout` berhasil, menggunakan token tersebut pada endpoint terproteksi mana pun SHALL menghasilkan HTTP status 401.

**Validates: Requirements 1.3**

---

### Property 3: Endpoint terproteksi menolak request tanpa token valid

*For any* endpoint terproteksi (`/api/users`, `/api/pasien`, `/api/penyakit`, `/api/pasien/{id}/diagnosa`) dan *for any* request yang tidak menyertakan token atau menyertakan token yang tidak valid, THE API_Server SHALL mengembalikan HTTP status 401.

**Validates: Requirements 1.4, 4.1, 5.1, 6.1, 7.1**

---

### Property 4: Create post lalu GET mengembalikan data yang sama (round-trip)

*For any* data post yang valid (`title`, `body`, `author`, `slug`, `status`), membuat post via `POST /api/posts` lalu mengambilnya via `GET /api/posts/{id}` SHALL mengembalikan data yang identik dengan data yang dikirim saat pembuatan, beserta daftar comments (kosong jika belum ada).

**Validates: Requirements 2.2, 2.4, 2.11**

---

### Property 5: Data post yang tidak valid selalu ditolak dengan 422

*For any* request `POST /api/posts` atau `PUT /api/posts/{id}` yang memiliki field wajib kosong, tipe data salah, atau slug yang sudah digunakan, THE API_Server SHALL mengembalikan HTTP status 422 dengan `success: false` dan daftar pesan validasi di field `errors`.

**Validates: Requirements 2.5, 2.10**

---

### Property 6: Menghapus post menghapus semua comments terkait (cascade)

*For any* post yang memiliki N comments (N ≥ 0), setelah request `DELETE /api/posts/{id}` berhasil, semua N comments yang memiliki `post_id` tersebut SHALL tidak lagi ada di database (tidak ada orphan comments).

**Validates: Requirements 2.8, 3.13**

---

### Property 7: Comment selalu menyertakan data post terkait

*For any* comment yang ada di database, request `GET /api/comments/{id}` SHALL mengembalikan data comment beserta objek `post` yang berisi data post induknya.

**Validates: Requirements 3.2**

---

### Property 8: Comment dengan post_id tidak valid selalu ditolak

*For any* request `POST /api/comments` yang menyertakan `post_id` yang tidak merujuk ke post yang ada, THE API_Server SHALL mengembalikan HTTP status 422 dengan pesan validasi.

**Validates: Requirements 3.7**

---

### Property 9: Field password tidak pernah muncul di response user

*For any* response API yang berisi data user (dari endpoint `GET /api/users`, `GET /api/users/{id}`, `POST /api/users`, `PUT /api/users/{id}`, maupun `POST /api/login`), field `password` SHALL tidak ada di dalam objek JSON yang dikembalikan.

**Validates: Requirements 4.9**

---

### Property 10: Diagnosa tidak dapat diduplikasi untuk pasien yang sama

*For any* pasien dan penyakit, mengirim `POST /api/pasien/{id}/diagnosa` dengan `penyakit_id` yang sudah ada dalam diagnosa pasien tersebut SHALL tidak menghasilkan entri duplikat di tabel `diagnosa` (idempotent terhadap duplikasi).

**Validates: Requirements 7.6**

---

### Property 11: Semua response API memiliki format JSON yang konsisten

*For any* request ke endpoint API mana pun:
- Jika operasi **berhasil**, response SHALL memiliki struktur `{"success": true, "message": "...", "data": {...}}`.
- Jika operasi **gagal**, response SHALL memiliki struktur `{"success": false, "message": "...", "errors": {...}}`.

**Validates: Requirements 8.2, 8.3**

---

## Error Handling

### Strategi Penanganan Error

Semua error ditangani secara terpusat melalui Laravel Exception Handler (`bootstrap/app.php`) untuk memastikan format respons yang konsisten.

#### Jenis Error dan Penanganannya

| Kondisi | HTTP Status | Penanganan |
|---|---|---|
| Resource tidak ditemukan (ModelNotFoundException) | 404 | Handler global mengembalikan `{"success": false, "message": "Data tidak ditemukan", "errors": {}}` |
| Validasi gagal (ValidationException) | 422 | Handler global mengembalikan `{"success": false, "message": "Data tidak valid", "errors": {...}}` |
| Tidak terautentikasi (AuthenticationException) | 401 | Handler global mengembalikan `{"success": false, "message": "Unauthenticated", "errors": {}}` |
| Kredensial login salah | 401 | AuthController mengembalikan pesan error spesifik |
| Server error (Exception) | 500 | Handler global mengembalikan pesan error generik (detail disembunyikan di production) |

#### Implementasi Exception Handler

```php
// bootstrap/app.php
$app->withExceptions(function (Exceptions $exceptions) {
    $exceptions->render(function (ModelNotFoundException $e, Request $request) {
        if ($request->is('api/*')) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
                'errors'  => (object) [],
            ], 404);
        }
    });

    $exceptions->render(function (AuthenticationException $e, Request $request) {
        if ($request->is('api/*')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
                'errors'  => (object) [],
            ], 401);
        }
    });
});
```

#### Validasi di Form Request

Setiap Form Request mengoverride method `failedValidation` untuk memastikan format error konsisten:

```php
protected function failedValidation(Validator $validator): void
{
    throw new HttpResponseException(response()->json([
        'success' => false,
        'message' => 'Data tidak valid',
        'errors'  => $validator->errors(),
    ], 422));
}
```

---

## Testing Strategy

### Pendekatan Pengujian

Proyek ini menggunakan dua lapisan pengujian yang saling melengkapi:

1. **Unit/Feature Tests** — Menguji contoh spesifik, edge case, dan kondisi error menggunakan PHPUnit (sudah tersedia di project).
2. **Property-Based Tests** — Menguji properti universal yang harus berlaku untuk semua input menggunakan library PBT.

### Library Property-Based Testing

Untuk PHP/Laravel, digunakan **[eris/eris](https://github.com/giorgiosironi/eris)** — library property-based testing untuk PHP yang terinspirasi dari QuickCheck.

```bash
composer require --dev eris/eris
```

Setiap property test dikonfigurasi untuk menjalankan minimum **100 iterasi**.

### Konfigurasi Tag Property Test

Setiap property test diberi tag komentar dengan format:

```php
/**
 * Feature: laravel-api-learning, Property {N}: {property_text}
 */
```

### Rencana Test per Property

#### Property 1: Kredensial tidak valid selalu ditolak
```php
/**
 * Feature: laravel-api-learning, Property 1: Kredensial tidak valid selalu ditolak
 */
public function test_invalid_credentials_always_rejected(): void
{
    // Generator: kombinasi email/password yang tidak valid
    // Verifikasi: semua menghasilkan 401 dengan success=false
}
```

#### Property 2: Token dicabut setelah logout
```php
/**
 * Feature: laravel-api-learning, Property 2: Token dicabut setelah logout
 */
public function test_token_revoked_after_logout(): void
{
    // Generator: user dengan token valid
    // Aksi: logout
    // Verifikasi: token tidak bisa digunakan lagi (401)
}
```

#### Property 3: Endpoint terproteksi menolak request tanpa token valid
```php
/**
 * Feature: laravel-api-learning, Property 3: Endpoint terproteksi menolak request tanpa token valid
 */
public function test_protected_endpoints_reject_unauthenticated(): void
{
    // Generator: semua endpoint terproteksi × berbagai token tidak valid
    // Verifikasi: semua menghasilkan 401
}
```

#### Property 4: Create post lalu GET mengembalikan data yang sama
```php
/**
 * Feature: laravel-api-learning, Property 4: Create post lalu GET mengembalikan data yang sama
 */
public function test_post_create_get_roundtrip(): void
{
    // Generator: data post yang valid (title, body, author, slug unik, status)
    // Aksi: POST /api/posts, lalu GET /api/posts/{id}
    // Verifikasi: data yang dikembalikan identik dengan yang dikirim
}
```

#### Property 5: Data post tidak valid selalu ditolak
```php
/**
 * Feature: laravel-api-learning, Property 5: Data post tidak valid selalu ditolak
 */
public function test_invalid_post_data_rejected(): void
{
    // Generator: data post dengan field wajib kosong atau slug duplikat
    // Verifikasi: semua menghasilkan 422 dengan errors
}
```

#### Property 6: Menghapus post menghapus semua comments terkait
```php
/**
 * Feature: laravel-api-learning, Property 6: Menghapus post menghapus semua comments terkait
 */
public function test_delete_post_cascades_to_comments(): void
{
    // Generator: post dengan N comments (N dari 0 hingga 10)
    // Aksi: DELETE /api/posts/{id}
    // Verifikasi: tidak ada comment dengan post_id tersebut di database
}
```

#### Property 7: Comment selalu menyertakan data post terkait
```php
/**
 * Feature: laravel-api-learning, Property 7: Comment selalu menyertakan data post terkait
 */
public function test_comment_response_includes_post(): void
{
    // Generator: comment yang valid dengan post terkait
    // Aksi: GET /api/comments/{id}
    // Verifikasi: response berisi objek post yang tidak null
}
```

#### Property 9: Field password tidak pernah muncul di response user
```php
/**
 * Feature: laravel-api-learning, Property 9: Field password tidak pernah muncul di response user
 */
public function test_password_never_in_user_response(): void
{
    // Generator: berbagai operasi user (create, read, update, login)
    // Verifikasi: tidak ada field password di response JSON
}
```

#### Property 10: Diagnosa tidak dapat diduplikasi
```php
/**
 * Feature: laravel-api-learning, Property 10: Diagnosa tidak dapat diduplikasi
 */
public function test_diagnosa_no_duplicate(): void
{
    // Generator: pasien dan penyakit yang valid
    // Aksi: tambah diagnosa yang sama dua kali
    // Verifikasi: hanya ada satu entri di tabel diagnosa
}
```

#### Property 11: Semua response API memiliki format konsisten
```php
/**
 * Feature: laravel-api-learning, Property 11: Semua response API memiliki format konsisten
 */
public function test_all_responses_have_consistent_format(): void
{
    // Generator: berbagai endpoint dan operasi (sukses dan gagal)
    // Verifikasi sukses: ada field success=true, message, data
    // Verifikasi gagal: ada field success=false, message, errors
}
```

### Unit/Feature Tests (Contoh Spesifik)

Selain property tests, unit/feature tests mencakup:

- Login berhasil dengan kredensial valid (Req 1.1)
- Halaman `/docs` mengembalikan 200 dengan HTML (Req 9.1, 9.6)
- GET `/api/posts` mengembalikan daftar semua post (Req 2.1)
- GET `/api/pasien/{id}` menyertakan daftar penyakit (Req 5.3)
- GET `/api/penyakit/{id}` menyertakan daftar pasien (Req 6.3)

### Menjalankan Tests

```bash
# Semua tests
php artisan test

# Hanya feature tests
php artisan test --testsuite=Feature

# Hanya unit tests
php artisan test --testsuite=Unit
```

---

## Blade View Structure (Halaman Dokumentasi)

### Layout Utama

```
resources/views/docs/
├── index.blade.php          ← Halaman utama, extends layout
└── partials/
    ├── auth.blade.php       ← Dokumentasi endpoint autentikasi
    ├── posts.blade.php      ← Dokumentasi endpoint Post
    ├── comments.blade.php   ← Dokumentasi endpoint Comment
    ├── users.blade.php      ← Dokumentasi endpoint User
    ├── pasien.blade.php     ← Dokumentasi endpoint Pasien
    ├── penyakit.blade.php   ← Dokumentasi endpoint Penyakit
    └── diagnosa.blade.php   ← Dokumentasi endpoint Diagnosa
```

### Struktur `index.blade.php`

```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel API Documentation</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Laravel API Docs</span>
        </div>
    </nav>

    <div class="container my-4">
        <!-- Sidebar navigasi endpoint -->
        <div class="row">
            <div class="col-md-3">
                <!-- Daftar link ke setiap section -->
            </div>
            <div class="col-md-9">
                <!-- Badge: PUBLIC vs PROTECTED -->
                <!-- Section per resource -->
                @include('docs.partials.auth')
                @include('docs.partials.posts')
                @include('docs.partials.comments')
                @include('docs.partials.users')
                @include('docs.partials.pasien')
                @include('docs.partials.penyakit')
                @include('docs.partials.diagnosa')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```

### Konvensi Visual

| Elemen | Tampilan Bootstrap |
|---|---|
| Badge "PUBLIC" | `<span class="badge bg-success">PUBLIC</span>` |
| Badge "PROTECTED" | `<span class="badge bg-warning text-dark">PROTECTED</span>` |
| Method GET | `<span class="badge bg-primary">GET</span>` |
| Method POST | `<span class="badge bg-success">POST</span>` |
| Method PUT | `<span class="badge bg-warning text-dark">PUT</span>` |
| Method DELETE | `<span class="badge bg-danger">DELETE</span>` |
| Contoh request/response | `<pre><code class="bg-light p-3 rounded">...</code></pre>` |
| Header Authorization | `<code>Authorization: Bearer {token}</code>` |

### Struktur Partial per Endpoint

Setiap partial mengikuti pola yang sama:

```html
<section id="posts" class="mb-5">
    <h2>Post <span class="badge bg-success">PUBLIC</span></h2>
    <hr>

    <!-- Satu card per endpoint -->
    <div class="card mb-3">
        <div class="card-header">
            <span class="badge bg-primary">GET</span>
            <code>/api/posts</code>
            — Daftar semua post
        </div>
        <div class="card-body">
            <h6>Response 200</h6>
            <pre><code>{ "success": true, "message": "...", "data": [...] }</code></pre>
        </div>
    </div>

    <!-- Endpoint terproteksi menampilkan header Authorization -->
    <div class="card mb-3">
        <div class="card-header">
            <span class="badge bg-warning text-dark">PROTECTED</span>
            <span class="badge bg-primary">GET</span>
            <code>/api/users</code>
        </div>
        <div class="card-body">
            <h6>Request Header</h6>
            <pre><code>Authorization: Bearer {token}</code></pre>
            <h6>Response 200</h6>
            <pre><code>{ "success": true, "message": "...", "data": [...] }</code></pre>
        </div>
    </div>
</section>
```
