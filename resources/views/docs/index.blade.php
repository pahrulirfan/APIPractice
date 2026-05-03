<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumentasi API</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
        }
        .content-wrapper {
            flex: 1 0 auto;
        }
        footer {
            flex-shrink: 0;
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
    <div class="content-wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <a href="/" class="navbar-brand fw-semibold">API Practice</a>
                <div class="d-flex gap-3">
                    <a href="/docs" class="text-white text-decoration-none small">Dokumentasi API</a>
                    <a href="/data" class="text-secondary text-decoration-none small">Data Viewer</a>
                </div>
            </div>
        </nav>

        <div class="container my-4">
            <div class="row g-4">
                <!-- Sidebar navigasi -->
                <div class="col-md-3">
                    <div class="sidebar">
                        <div class="card shadow-sm border-0">
                            <div class="card-body p-0">
                                <div class="sidebar-heading mt-2">API Endpoints</div>
                                <div class="list-group list-group-flush rounded">
                                    <a href="/docs/auth" class="list-group-item list-group-item-action {{ isset($section) && $section === 'auth' ? 'active' : '' }}">
                                        Autentikasi
                                    </a>
                                    <a href="/docs/posts" class="list-group-item list-group-item-action {{ isset($section) && $section === 'posts' ? 'active' : '' }}">
                                        Posts
                                    </a>
                                    <a href="/docs/comments" class="list-group-item list-group-item-action {{ isset($section) && $section === 'comments' ? 'active' : '' }}">
                                        Comments
                                    </a>
                                    <a href="/docs/users" class="list-group-item list-group-item-action {{ isset($section) && $section === 'users' ? 'active' : '' }}">
                                        Users <small class="text-muted">🔒</small>
                                    </a>
                                    <a href="/docs/pasien" class="list-group-item list-group-item-action {{ isset($section) && $section === 'pasien' ? 'active' : '' }}">
                                        Pasien <small class="text-muted">🔒</small>
                                    </a>
                                    <a href="/docs/penyakit" class="list-group-item list-group-item-action {{ isset($section) && $section === 'penyakit' ? 'active' : '' }}">
                                        Penyakit <small class="text-muted">🔒</small>
                                    </a>
                                    <a href="/docs/diagnosa" class="list-group-item list-group-item-action {{ isset($section) && $section === 'diagnosa' ? 'active' : '' }}">
                                        Diagnosa <small class="text-muted">🔒</small>
                                    </a>
                                    <a href="/docs/vehicles" class="list-group-item list-group-item-action {{ isset($section) && $section === 'vehicles' ? 'active' : '' }}">
                                        Vehicles
                                    </a>
                                    <a href="/docs/medicines" class="list-group-item list-group-item-action {{ isset($section) && $section === 'medicines' ? 'active' : '' }}">
                                        Medicines
                                    </a>
                                </div>

                                <div class="sidebar-heading mt-3">Keterangan</div>
                                <div class="px-3 pb-3 small text-muted">
                                    <div class="mb-1">🔒 = Memerlukan Bearer token</div>
                                    <div>Lainnya = Akses publik</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Konten utama -->
                <div class="col-md-9">
                    @if(!isset($section))
                        <!-- Welcome screen -->
                        <div class="mb-4">
                            <h1 class="h3 fw-bold">API Practice — Dokumentasi</h1>
                            <p class="text-muted">Dokumentasi lengkap untuk semua endpoint REST API. Base URL: <code>https://api.pahrul.my.id/</code></p>
                            <hr>
                        </div>

                        <div class="text-center py-5">
                            <h2 class="h4 fw-bold mb-3">Pilih Endpoint</h2>
                            <p class="text-muted mb-4">Pilih endpoint dari sidebar untuk melihat dokumentasi lengkap</p>
                            <div class="row g-3 mt-4">
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Autentikasi</h5>
                                            <p class="card-text small text-muted">Login & Logout</p>
                                            <a href="/docs/auth" class="btn btn-sm btn-outline-primary">Lihat Docs</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Posts</h5>
                                            <p class="card-text small text-muted">Artikel & konten</p>
                                            <a href="/docs/posts" class="btn btn-sm btn-outline-primary">Lihat Docs</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Comments</h5>
                                            <p class="card-text small text-muted">Komentar pengguna</p>
                                            <a href="/docs/comments" class="btn btn-sm btn-outline-primary">Lihat Docs</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Users 🔒</h5>
                                            <p class="card-text small text-muted">Manajemen user</p>
                                            <a href="/docs/users" class="btn btn-sm btn-outline-primary">Lihat Docs</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Pasien 🔒</h5>
                                            <p class="card-text small text-muted">Data pasien medis</p>
                                            <a href="/docs/pasien" class="btn btn-sm btn-outline-primary">Lihat Docs</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Penyakit 🔒</h5>
                                            <p class="card-text small text-muted">Data penyakit ICD</p>
                                            <a href="/docs/penyakit" class="btn btn-sm btn-outline-primary">Lihat Docs</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Diagnosa 🔒</h5>
                                            <p class="card-text small text-muted">Relasi pasien & penyakit</p>
                                            <a href="/docs/diagnosa" class="btn btn-sm btn-outline-primary">Lihat Docs</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Vehicles</h5>
                                            <p class="card-text small text-muted">Data kendaraan</p>
                                            <a href="/docs/vehicles" class="btn btn-sm btn-outline-primary">Lihat Docs</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Medicines</h5>
                                            <p class="card-text small text-muted">Data obat-obatan</p>
                                            <a href="/docs/medicines" class="btn btn-sm btn-outline-primary">Lihat Docs</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(isset($section) && $section === 'auth')
                        @include('docs.partials.auth')
                    @endif

                    @if(isset($section) && $section === 'posts')
                        @include('docs.partials.posts')
                    @endif

                    @if(isset($section) && $section === 'comments')
                        @include('docs.partials.comments')
                    @endif

                    @if(isset($section) && $section === 'users')
                        @include('docs.partials.users')
                    @endif

                    @if(isset($section) && $section === 'pasien')
                        @include('docs.partials.pasien')
                    @endif

                    @if(isset($section) && $section === 'penyakit')
                        @include('docs.partials.penyakit')
                    @endif

                    @if(isset($section) && $section === 'diagnosa')
                        @include('docs.partials.diagnosa')
                    @endif

                    @if(isset($section) && $section === 'vehicles')
                        @include('docs.partials.vehicles')
                    @endif

                    @if(isset($section) && $section === 'medicines')
                        @include('docs.partials.medicines')
                    @endif
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-secondary text-center py-3 small">
        API Practice &mdash; Laravel 11 + Bootstrap 5
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
