<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi API</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            position: sticky;
            top: 1rem;
        }
        .sidebar .list-group-item {
            border-left: 3px solid transparent;
            transition: border-color 0.2s;
        }
        .sidebar .list-group-item:hover {
            border-left-color: #0d6efd;
            background-color: #e9ecef;
        }
        .sidebar .list-group-item.active {
            border-left-color: #0d6efd;
        }
        .sidebar-heading {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #6c757d;
            padding: 0.5rem 1rem;
        }
        pre code {
            font-size: 0.85rem;
        }
        section {
            scroll-margin-top: 1rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a href="/" class="navbar-brand fw-semibold">API Practice</a>
            <span class="text-secondary small">Dokumentasi API</span>
        </div>
    </nav>

    <div class="container my-4">
        <div class="row g-4">
            <!-- Sidebar navigasi -->
            <div class="col-md-3">
                <div class="sidebar">
                    <div class="card shadow-sm border-0">
                        <div class="card-body p-0">
                            <div class="sidebar-heading mt-2">Navigasi</div>
                            <div class="list-group list-group-flush rounded">
                                <a href="#auth" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                                    <span class="badge bg-success" style="font-size:0.65rem;">PUBLIC</span>
                                    Autentikasi
                                </a>
                                <a href="#posts" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                                    <span class="badge bg-success" style="font-size:0.65rem;">PUBLIC</span>
                                    Posts
                                </a>
                                <a href="#comments" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                                    <span class="badge bg-success" style="font-size:0.65rem;">PUBLIC</span>
                                    Comments
                                </a>
                                <a href="#users" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                                    <span class="badge bg-warning text-dark" style="font-size:0.65rem;">PROTECTED</span>
                                    Users
                                </a>
                                <a href="#pasien" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                                    <span class="badge bg-warning text-dark" style="font-size:0.65rem;">PROTECTED</span>
                                    Pasien
                                </a>
                                <a href="#penyakit" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                                    <span class="badge bg-warning text-dark" style="font-size:0.65rem;">PROTECTED</span>
                                    Penyakit
                                </a>
                                <a href="#diagnosa" class="list-group-item list-group-item-action d-flex align-items-center gap-2">
                                    <span class="badge bg-warning text-dark" style="font-size:0.65rem;">PROTECTED</span>
                                    Diagnosa
                                </a>
                            </div>

                            <div class="sidebar-heading mt-3">Keterangan</div>
                            <div class="px-3 pb-3">
                                <div class="d-flex align-items-center gap-2 mb-1">
                                    <span class="badge bg-success">PUBLIC</span>
                                    <small class="text-muted">Tanpa autentikasi</small>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="badge bg-warning text-dark">PROTECTED</span>
                                    <small class="text-muted">Perlu Bearer token</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten utama -->
            <div class="col-md-9">
                <div class="mb-4">
                    <h1 class="h3 fw-bold">API Practice — Dokumentasi</h1>
                    <p class="text-muted">Dokumentasi lengkap untuk semua endpoint REST API. Base URL: <code>http://localhost:8000</code></p>
                    <hr>
                </div>

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

    <footer class="bg-dark text-secondary text-center py-3 mt-5 small">
        API Practice &mdash; Laravel 11 + Bootstrap 5
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
