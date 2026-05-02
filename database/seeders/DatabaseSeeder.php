<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Pasien;
use App\Models\Penyakit;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ─── Users ───────────────────────────────────────────────────────────
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'      => 'Admin',
                'password'  => Hash::make('qweqwe'),
                'role'      => 'admin',
                'is_active' => true,
            ]
        );

        $users = [
            ['name' => 'Budi Santoso',   'email' => 'budi@example.com',   'role' => 'user',  'is_active' => true],
            ['name' => 'Siti Rahayu',    'email' => 'siti@example.com',   'role' => 'user',  'is_active' => true],
            ['name' => 'Agus Wijaya',    'email' => 'agus@example.com',   'role' => 'user',  'is_active' => false],
            ['name' => 'Dewi Lestari',   'email' => 'dewi@example.com',   'role' => 'user',  'is_active' => true],
            ['name' => 'Rudi Hermawan',  'email' => 'rudi@example.com',   'role' => 'admin', 'is_active' => true],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                array_merge($userData, ['password' => Hash::make('password')])
            );
        }

        // ─── Posts ────────────────────────────────────────────────────────────
        $postsData = [
            [
                'title'  => 'Pengenalan Laravel Framework',
                'body'   => 'Laravel adalah framework PHP yang elegan dan ekspresif. Dengan sintaks yang bersih dan fitur-fitur modern, Laravel memudahkan pengembangan aplikasi web.',
                'author' => 'Budi Santoso',
                'slug'   => 'pengenalan-laravel-framework',
                'status' => 'published',
            ],
            [
                'title'  => 'Membangun RESTful API dengan Laravel',
                'body'   => 'RESTful API adalah arsitektur yang populer untuk komunikasi antara client dan server. Laravel menyediakan tools yang lengkap untuk membangun API yang robust.',
                'author' => 'Siti Rahayu',
                'slug'   => 'membangun-restful-api-laravel',
                'status' => 'published',
            ],
            [
                'title'  => 'Autentikasi dengan Laravel Sanctum',
                'body'   => 'Laravel Sanctum menyediakan sistem autentikasi yang ringan untuk SPA, mobile app, dan API berbasis token. Mudah dikonfigurasi dan aman digunakan.',
                'author' => 'Agus Wijaya',
                'slug'   => 'autentikasi-laravel-sanctum',
                'status' => 'published',
            ],
            [
                'title'  => 'Eloquent ORM: Relasi Antar Model',
                'body'   => 'Eloquent ORM memudahkan pengelolaan relasi antar tabel database. Mulai dari one-to-many, many-to-many, hingga polymorphic relations.',
                'author' => 'Dewi Lestari',
                'slug'   => 'eloquent-orm-relasi-antar-model',
                'status' => 'draft',
            ],
            [
                'title'  => 'Validasi Input di Laravel',
                'body'   => 'Laravel menyediakan berbagai cara untuk memvalidasi input pengguna. Form Request adalah cara yang paling terstruktur dan reusable untuk validasi.',
                'author' => 'Rudi Hermawan',
                'slug'   => 'validasi-input-laravel',
                'status' => 'published',
            ],
            [
                'title'  => 'Migrasi Database di Laravel',
                'body'   => 'Migrasi database memungkinkan tim untuk mengelola skema database secara terstruktur dan version-controlled. Setiap perubahan skema dapat di-rollback dengan mudah.',
                'author' => 'Budi Santoso',
                'slug'   => 'migrasi-database-laravel',
                'status' => 'draft',
            ],
        ];

        $posts = [];
        foreach ($postsData as $postData) {
            $posts[] = Post::updateOrCreate(['slug' => $postData['slug']], $postData);
        }

        // ─── Comments ─────────────────────────────────────────────────────────
        $commentsData = [
            // Post 1 comments
            ['post_index' => 0, 'name' => 'Ahmad Fauzi',    'email' => 'ahmad@example.com',  'body' => 'Artikel yang sangat informatif! Terima kasih sudah berbagi.',                    'status' => 'approved'],
            ['post_index' => 0, 'name' => 'Rina Marlina',   'email' => 'rina@example.com',   'body' => 'Saya baru mulai belajar Laravel, artikel ini sangat membantu.',                  'status' => 'approved'],
            // Post 2 comments
            ['post_index' => 1, 'name' => 'Hendra Gunawan', 'email' => 'hendra@example.com', 'body' => 'Penjelasan tentang RESTful API sangat jelas dan mudah dipahami.',                'status' => 'approved'],
            ['post_index' => 1, 'name' => 'Yuni Astuti',    'email' => 'yuni@example.com',   'body' => 'Bisa tambahkan contoh untuk endpoint DELETE juga?',                             'status' => 'pending'],
            // Post 3 comments
            ['post_index' => 2, 'name' => 'Doni Prasetyo',  'email' => 'doni@example.com',   'body' => 'Sanctum memang lebih simpel dibanding Passport untuk use case sederhana.',       'status' => 'approved'],
            // Post 4 comments
            ['post_index' => 3, 'name' => 'Mega Wulandari', 'email' => 'mega@example.com',   'body' => 'Ditunggu artikel lanjutannya tentang polymorphic relations!',                   'status' => 'approved'],
            // Post 5 comments
            ['post_index' => 4, 'name' => 'Fajar Nugroho',  'email' => 'fajar@example.com',  'body' => 'Form Request memang cara terbaik untuk validasi, kode jadi lebih rapi.',        'status' => 'approved'],
            ['post_index' => 4, 'name' => 'Lina Susanti',   'email' => 'lina@example.com',   'body' => 'Bagaimana cara menampilkan pesan error validasi dalam bahasa Indonesia?',       'status' => 'pending'],
        ];

        foreach ($commentsData as $commentData) {
            $postId = $posts[$commentData['post_index']]->id;
            Comment::firstOrCreate(
                [
                    'post_id' => $postId,
                    'email'   => $commentData['email'],
                    'body'    => $commentData['body'],
                ],
                [
                    'name'   => $commentData['name'],
                    'status' => $commentData['status'],
                ]
            );
        }

        // ─── Penyakit ─────────────────────────────────────────────────────────
        $penyakitData = [
            ['kode_icd' => 'A00', 'nama' => 'Kolera',              'deskripsi' => 'Infeksi usus akut yang disebabkan oleh bakteri Vibrio cholerae.',                    'kategori' => 'Infeksi'],
            ['kode_icd' => 'A15', 'nama' => 'Tuberkulosis Paru',   'deskripsi' => 'Penyakit infeksi menular yang disebabkan oleh Mycobacterium tuberculosis.',          'kategori' => 'Infeksi'],
            ['kode_icd' => 'E11', 'nama' => 'Diabetes Melitus Tipe 2', 'deskripsi' => 'Gangguan metabolisme yang ditandai dengan kadar gula darah tinggi secara kronis.', 'kategori' => 'Metabolik'],
            ['kode_icd' => 'I10', 'nama' => 'Hipertensi Esensial', 'deskripsi' => 'Tekanan darah tinggi yang tidak diketahui penyebab spesifiknya.',                   'kategori' => 'Kardiovaskular'],
            ['kode_icd' => 'J18', 'nama' => 'Pneumonia',           'deskripsi' => 'Infeksi yang menyebabkan peradangan pada kantung udara di paru-paru.',               'kategori' => 'Pernapasan'],
            ['kode_icd' => 'K29', 'nama' => 'Gastritis',           'deskripsi' => 'Peradangan pada lapisan lambung yang dapat bersifat akut maupun kronis.',            'kategori' => 'Pencernaan'],
            ['kode_icd' => 'M54', 'nama' => 'Nyeri Punggung',      'deskripsi' => 'Nyeri yang terjadi di area punggung, bisa disebabkan oleh berbagai faktor.',         'kategori' => 'Muskuloskeletal'],
        ];

        $penyakitList = [];
        foreach ($penyakitData as $data) {
            $penyakitList[] = Penyakit::updateOrCreate(['kode_icd' => $data['kode_icd']], $data);
        }

        // ─── Pasien ───────────────────────────────────────────────────────────
        $pasienData = [
            ['nama' => 'Bambang Supriyadi', 'tanggal_lahir' => '1975-03-15', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Merdeka No. 10, Jakarta',       'no_telepon' => '081234567890'],
            ['nama' => 'Sri Wahyuni',       'tanggal_lahir' => '1988-07-22', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Sudirman No. 45, Bandung',       'no_telepon' => '082345678901'],
            ['nama' => 'Eko Prasetyo',      'tanggal_lahir' => '1992-11-08', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Diponegoro No. 7, Surabaya',     'no_telepon' => '083456789012'],
            ['nama' => 'Fitri Handayani',   'tanggal_lahir' => '1980-05-30', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Gatot Subroto No. 22, Semarang', 'no_telepon' => '084567890123'],
            ['nama' => 'Hadi Kusuma',       'tanggal_lahir' => '1965-09-12', 'jenis_kelamin' => 'L', 'alamat' => 'Jl. Ahmad Yani No. 55, Yogyakarta',  'no_telepon' => '085678901234'],
            ['nama' => 'Indah Permata',     'tanggal_lahir' => '1995-01-25', 'jenis_kelamin' => 'P', 'alamat' => 'Jl. Pahlawan No. 3, Medan',          'no_telepon' => '086789012345'],
        ];

        $pasienList = [];
        foreach ($pasienData as $data) {
            $pasienList[] = Pasien::firstOrCreate(['no_telepon' => $data['no_telepon']], $data);
        }

        // ─── Diagnosa (relasi Pasien ↔ Penyakit) ─────────────────────────────
        // Pivot data: [penyakit_id => ['catatan' => '...', 'created_at' => ..., 'updated_at' => ...]]
        $now = now();

        $diagnosaMap = [
            // Bambang: Hipertensi + Diabetes
            0 => [
                $penyakitList[3]->id => ['catatan' => 'Tekanan darah 160/100, perlu kontrol rutin.',          'created_at' => $now, 'updated_at' => $now],
                $penyakitList[2]->id => ['catatan' => 'Gula darah puasa 210 mg/dL, diet ketat disarankan.',   'created_at' => $now, 'updated_at' => $now],
            ],
            // Sri: Gastritis + Nyeri Punggung
            1 => [
                $penyakitList[5]->id => ['catatan' => 'Nyeri ulu hati, hindari makanan pedas dan asam.',      'created_at' => $now, 'updated_at' => $now],
                $penyakitList[6]->id => ['catatan' => 'Nyeri punggung bawah, disarankan fisioterapi.',        'created_at' => $now, 'updated_at' => $now],
            ],
            // Eko: Tuberkulosis + Pneumonia
            2 => [
                $penyakitList[1]->id => ['catatan' => 'BTA positif, sedang menjalani terapi OAT 6 bulan.',    'created_at' => $now, 'updated_at' => $now],
                $penyakitList[4]->id => ['catatan' => 'Infiltrat di lobus kanan atas, antibiotik diberikan.', 'created_at' => $now, 'updated_at' => $now],
            ],
            // Fitri: Hipertensi + Gastritis
            3 => [
                $penyakitList[3]->id => ['catatan' => 'Hipertensi grade 1, mulai terapi amlodipine 5mg.',     'created_at' => $now, 'updated_at' => $now],
                $penyakitList[5]->id => ['catatan' => 'Gastritis kronis, endoskopi dijadwalkan bulan depan.', 'created_at' => $now, 'updated_at' => $now],
            ],
            // Hadi: Diabetes + Hipertensi + Nyeri Punggung
            4 => [
                $penyakitList[2]->id => ['catatan' => 'DM tipe 2 dengan komplikasi neuropati perifer.',       'created_at' => $now, 'updated_at' => $now],
                $penyakitList[3]->id => ['catatan' => 'Hipertensi terkontrol dengan captopril 25mg.',         'created_at' => $now, 'updated_at' => $now],
                $penyakitList[6]->id => ['catatan' => 'Hernia nukleus pulposus L4-L5, MRI sudah dilakukan.',  'created_at' => $now, 'updated_at' => $now],
            ],
            // Indah: Kolera
            5 => [
                $penyakitList[0]->id => ['catatan' => 'Dehidrasi berat, rawat inap dan rehidrasi IV.',        'created_at' => $now, 'updated_at' => $now],
            ],
        ];

        foreach ($diagnosaMap as $pasienIndex => $pivotData) {
            $pasienList[$pasienIndex]->penyakit()->syncWithoutDetaching($pivotData);
        }
    }
}
