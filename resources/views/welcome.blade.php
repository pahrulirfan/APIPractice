<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Practice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand fw-semibold">API Practice</span>
            <a href="/docs" class="btn btn-outline-light btn-sm">Dokumentasi API</a>
        </div>
    </nav>

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="mb-5">
                    <h1 class="h2 fw-bold mb-2">API Practice</h1>
                    <p class="text-muted mb-0">
                        Proyek latihan membangun RESTful API dengan Laravel. Endpoint dibagi menjadi dua kelompok:
                        <strong>publik</strong> (tanpa autentikasi) dan <strong>terproteksi</strong> (memerlukan Bearer token Sanctum).
                    </p>
                </div>

                <div class="row g-3 mb-5">
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-title fw-semibold">Autentikasi</h6>
                                <p class="card-text text-muted small">Login dan logout menggunakan Laravel Sanctum untuk mendapatkan Bearer token.</p>
                                <div class="d-flex flex-wrap gap-1 mt-2">
                                    <code class="small text-success">POST /api/login</code><br>
                                    <code class="small text-secondary">POST /api/logout</code>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-title fw-semibold">API Publik</h6>
                                <p class="card-text text-muted small">CRUD Post dan Comment. Dapat diakses tanpa autentikasi.</p>
                                <div class="mt-2">
                                    <code class="small text-success d-block">GET /api/posts</code>
                                    <code class="small text-success d-block">GET /api/comments</code>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="card-title fw-semibold">API Terproteksi</h6>
                                <p class="card-text text-muted small">CRUD User, Pasien, Penyakit, dan Diagnosa. Memerlukan Bearer token.</p>
                                <div class="mt-2">
                                    <code class="small text-warning d-block">GET /api/users</code>
                                    <code class="small text-warning d-block">GET /api/pasien</code>
                                    <code class="small text-warning d-block">GET /api/penyakit</code>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-white fw-semibold">Stack Teknologi</div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-muted" style="width:140px">Framework</td>
                                    <td>Laravel 11</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Autentikasi</td>
                                    <td>Laravel Sanctum (token-based)</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Database</td>
                                    <td>SQLite / MySQL</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Testing</td>
                                    <td>PHPUnit Feature Tests</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Dokumentasi</td>
                                    <td>Blade + Bootstrap 5</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <a href="/docs" class="btn btn-dark">Lihat Dokumentasi API</a>
                    <a href="/api/posts" class="btn btn-outline-secondary">Coba GET /api/posts</a>
                </div>

            </div>
        </div>

    </div>

    <footer class="border-top mt-5 py-3 text-center text-muted small">
        API Practice &mdash; Laravel 11 + Bootstrap 5
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
