<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Viewer</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
        .table-responsive {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
            padding: 1rem;
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
                    <a href="/docs" class="text-secondary text-decoration-none small">Dokumentasi API</a>
                    <a href="/data" class="text-white text-decoration-none small">Data Viewer</a>
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
                                <div class="sidebar-heading mt-2">Data Tables</div>
                                <div class="list-group list-group-flush rounded">
                                    <a href="/data/posts" class="list-group-item list-group-item-action {{ isset($table) && $table === 'posts' ? 'active' : '' }}">
                                        Posts
                                    </a>
                                    <a href="/data/comments" class="list-group-item list-group-item-action {{ isset($table) && $table === 'comments' ? 'active' : '' }}">
                                        Comments
                                    </a>
                                    <a href="/data/users" class="list-group-item list-group-item-action {{ isset($table) && $table === 'users' ? 'active' : '' }}">
                                        Users
                                    </a>
                                    <a href="/data/pasien" class="list-group-item list-group-item-action {{ isset($table) && $table === 'pasien' ? 'active' : '' }}">
                                        Pasien
                                    </a>
                                    <a href="/data/penyakit" class="list-group-item list-group-item-action {{ isset($table) && $table === 'penyakit' ? 'active' : '' }}">
                                        Penyakit
                                    </a>
                                    <a href="/data/diagnosa" class="list-group-item list-group-item-action {{ isset($table) && $table === 'diagnosa' ? 'active' : '' }}">
                                        Diagnosa
                                    </a>
                                    <a href="/data/vehicles" class="list-group-item list-group-item-action {{ isset($table) && $table === 'vehicles' ? 'active' : '' }}">
                                        Vehicles
                                    </a>
                                    <a href="/data/medicines" class="list-group-item list-group-item-action {{ isset($table) && $table === 'medicines' ? 'active' : '' }}">
                                        Medicines
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Konten utama -->
                <div class="col-md-9">
                    @if(!isset($table))
                        <!-- Welcome screen -->
                        <div class="text-center py-5">
                            <h1 class="h3 fw-bold mb-3">Data Viewer</h1>
                            <p class="text-muted mb-4">Pilih tabel dari sidebar untuk melihat data yang tersimpan di database</p>
                            <div class="row g-3 mt-4">
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Posts</h5>
                                            <p class="card-text small text-muted">Artikel dan konten</p>
                                            <a href="/data/posts" class="btn btn-sm btn-outline-primary">Lihat Data</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Comments</h5>
                                            <p class="card-text small text-muted">Komentar pengguna</p>
                                            <a href="/data/comments" class="btn btn-sm btn-outline-primary">Lihat Data</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Users</h5>
                                            <p class="card-text small text-muted">Data pengguna</p>
                                            <a href="/data/users" class="btn btn-sm btn-outline-primary">Lihat Data</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Pasien</h5>
                                            <p class="card-text small text-muted">Data pasien medis</p>
                                            <a href="/data/pasien" class="btn btn-sm btn-outline-primary">Lihat Data</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Penyakit</h5>
                                            <p class="card-text small text-muted">Data penyakit ICD</p>
                                            <a href="/data/penyakit" class="btn btn-sm btn-outline-primary">Lihat Data</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Diagnosa</h5>
                                            <p class="card-text small text-muted">Relasi pasien & penyakit</p>
                                            <a href="/data/diagnosa" class="btn btn-sm btn-outline-primary">Lihat Data</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Vehicles</h5>
                                            <p class="card-text small text-muted">Data kendaraan</p>
                                            <a href="/data/vehicles" class="btn btn-sm btn-outline-primary">Lihat Data</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card border-0 shadow-sm h-100">
                                        <div class="card-body text-center">
                                            <h5 class="card-title">Medicines</h5>
                                            <p class="card-text small text-muted">Data obat-obatan</p>
                                            <a href="/data/medicines" class="btn btn-sm btn-outline-primary">Lihat Data</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(isset($table) && $table === 'posts')
                        @include('data.partials.posts')
                    @endif

                    @if(isset($table) && $table === 'comments')
                        @include('data.partials.comments')
                    @endif

                    @if(isset($table) && $table === 'users')
                        @include('data.partials.users')
                    @endif

                    @if(isset($table) && $table === 'pasien')
                        @include('data.partials.pasien')
                    @endif

                    @if(isset($table) && $table === 'penyakit')
                        @include('data.partials.penyakit')
                    @endif

                    @if(isset($table) && $table === 'diagnosa')
                        @include('data.partials.diagnosa')
                    @endif

                    @if(isset($table) && $table === 'vehicles')
                        @include('data.partials.vehicles')
                    @endif

                    @if(isset($table) && $table === 'medicines')
                        @include('data.partials.medicines')
                    @endif
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-dark text-secondary text-center py-3 small">
        API Practice &mdash; Laravel 11 + Bootstrap 5
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    @if(isset($table))
    <script>
        $(document).ready(function() {
            @if($table === 'posts')
            $('#posts-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url("/data/posts") }}',
                columns: [
                    { data: 'id', name: 'id', width: '50px' },
                    { data: 'title', name: 'title' },
                    { data: 'body', name: 'body' },
                    { data: 'author', name: 'author' },
                    { data: 'status', name: 'status' },
                    { data: 'comments_count', name: 'comments_count', orderable: false, searchable: false },
                    { data: 'created_at', name: 'created_at' }
                ],
                order: [[0, 'desc']]
            });
            @elseif($table === 'comments')
            $('#comments-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url("/data/comments") }}',
                columns: [
                    { data: 'id', name: 'id', width: '50px' },
                    { data: 'body', name: 'body' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'post_title', name: 'post_title', orderable: false, searchable: false },
                    { data: 'created_at', name: 'created_at' }
                ],
                order: [[0, 'desc']]
            });
            @elseif($table === 'users')
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url("/data/users") }}',
                columns: [
                    { data: 'id', name: 'id', width: '50px' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'role' },
                    { data: 'is_active', name: 'is_active' },
                    { data: 'created_at', name: 'created_at' }
                ],
                order: [[0, 'desc']]
            });
            @elseif($table === 'pasien')
            $('#pasien-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url("/data/pasien") }}',
                columns: [
                    { data: 'id', name: 'id', width: '50px' },
                    { data: 'nama', name: 'nama' },
                    { data: 'tanggal_lahir', name: 'tanggal_lahir' },
                    { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                    { data: 'alamat', name: 'alamat' },
                    { data: 'no_telepon', name: 'no_telepon' },
                    { data: 'created_at', name: 'created_at' }
                ],
                order: [[0, 'desc']]
            });
            @elseif($table === 'penyakit')
            $('#penyakit-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url("/data/penyakit") }}',
                columns: [
                    { data: 'id', name: 'id', width: '50px' },
                    { data: 'kode_icd', name: 'kode_icd' },
                    { data: 'nama', name: 'nama' },
                    { data: 'kategori', name: 'kategori' },
                    { data: 'deskripsi', name: 'deskripsi' },
                    { data: 'created_at', name: 'created_at' }
                ],
                order: [[0, 'desc']]
            });
            @elseif($table === 'diagnosa')
            $('#diagnosa-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url("/data/diagnosa") }}',
                columns: [
                    { data: 'id', name: 'id', width: '50px' },
                    { data: 'pasien_nama', name: 'pasien_nama' },
                    { data: 'pasien_info', name: 'pasien_info', orderable: false, searchable: false },
                    { data: 'penyakit_nama', name: 'penyakit_nama' },
                    { data: 'kode_icd', name: 'kode_icd' },
                    { data: 'kategori', name: 'kategori' },
                    { data: 'catatan', name: 'catatan' },
                    { data: 'created_at', name: 'created_at' }
                ],
                order: [[0, 'desc']]
            });
            @elseif($table === 'vehicles')
            $('#vehicles-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url("/data/vehicles") }}',
                columns: [
                    { data: 'id', name: 'id', width: '50px' },
                    { data: 'model', name: 'model' },
                    { data: 'type', name: 'type' },
                    { data: 'manufacturer', name: 'manufacturer' },
                    { data: 'created_at', name: 'created_at' }
                ],
                order: [[0, 'desc']]
            });
            @elseif($table === 'medicines')
            $('#medicines-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url("/data/medicines") }}',
                columns: [
                    { data: 'id', name: 'id', width: '50px' },
                    { data: 'name', name: 'name' },
                    { data: 'brand', name: 'brand' },
                    { data: 'manufacturer', name: 'manufacturer' },
                    { data: 'created_at', name: 'created_at' }
                ],
                order: [[0, 'desc']]
            });
            @endif
        });
    </script>
    @endif
</body>
</html>
