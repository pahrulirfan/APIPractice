<section id="posts" class="mb-5">
    <h2 class="h4 fw-bold">Post <span class="badge bg-success">PUBLIC</span></h2>
    <p class="text-muted">Endpoint untuk mengelola data post. Semua endpoint bersifat publik dan tidak memerlukan autentikasi.</p>
    <hr>

    <div class="accordion shadow-sm" id="accordion-posts">

        {{-- GET /api/posts --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#posts-index">
                    <span class="badge bg-primary me-2">GET</span>
                    <span class="badge bg-success me-2">PUBLIC</span>
                    <code class="me-2">/api/posts</code>
                    <span class="text-muted small">— Daftar semua post</span>
                </button>
            </h2>
            <div id="posts-index" class="accordion-collapse collapse" data-bs-parent="#accordion-posts">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data post ditemukan",
  "data": [
    {
      "id": 1,
      "title": "Judul Post",
      "body": "Isi konten post...",
      "author": "Nama Penulis",
      "slug": "judul-post",
      "status": "published",
      "created_at": "2024-01-01T00:00:00.000000Z",
      "updated_at": "2024-01-01T00:00:00.000000Z"
    }
  ]
}</code></pre>
                </div>
            </div>
        </div>

        {{-- GET /api/posts/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#posts-show">
                    <span class="badge bg-primary me-2">GET</span>
                    <span class="badge bg-success me-2">PUBLIC</span>
                    <code class="me-2">/api/posts/{id}</code>
                    <span class="text-muted small">— Detail post + comments</span>
                </button>
            </h2>
            <div id="posts-show" class="accordion-collapse collapse" data-bs-parent="#accordion-posts">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
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
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Post Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- POST /api/posts --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#posts-store">
                    <span class="badge bg-success me-2">POST</span>
                    <span class="badge bg-success me-2">PUBLIC</span>
                    <code class="me-2">/api/posts</code>
                    <span class="text-muted small">— Buat post baru</span>
                </button>
            </h2>
            <div id="posts-store" class="accordion-collapse collapse" data-bs-parent="#accordion-posts">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "title": "Judul Post",
  "body": "Isi konten post...",
  "author": "Nama Penulis",
  "slug": "judul-post",
  "status": "published"
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 201 — Berhasil Dibuat</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
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
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 422 — Validasi Gagal</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak valid",
  "errors": {
    "title": ["The title field is required."],
    "slug": ["The slug has already been taken."]
  }
}</code></pre>
                </div>
            </div>
        </div>

        {{-- PUT /api/posts/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#posts-update">
                    <span class="badge bg-warning text-dark me-2">PUT</span>
                    <span class="badge bg-success me-2">PUBLIC</span>
                    <code class="me-2">/api/posts/{id}</code>
                    <span class="text-muted small">— Update post</span>
                </button>
            </h2>
            <div id="posts-update" class="accordion-collapse collapse" data-bs-parent="#accordion-posts">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "title": "Judul Post Diperbarui",
  "body": "Isi konten post yang diperbarui...",
  "author": "Nama Penulis",
  "slug": "judul-post-diperbarui",
  "status": "published"
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil Diperbarui</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Post berhasil diperbarui",
  "data": {
    "id": 1,
    "title": "Judul Post Diperbarui",
    "body": "Isi konten post yang diperbarui...",
    "author": "Nama Penulis",
    "slug": "judul-post-diperbarui",
    "status": "published",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Post Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- DELETE /api/posts/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#posts-destroy">
                    <span class="badge bg-danger me-2">DELETE</span>
                    <span class="badge bg-success me-2">PUBLIC</span>
                    <code class="me-2">/api/posts/{id}</code>
                    <span class="text-muted small">— Hapus post + comments</span>
                </button>
            </h2>
            <div id="posts-destroy" class="accordion-collapse collapse" data-bs-parent="#accordion-posts">
                <div class="accordion-body">
                    <p class="text-muted small mb-3">Menghapus post beserta semua comments terkait secara otomatis (cascade delete).</p>

                    <h6 class="fw-semibold">Response 200 — Berhasil Dihapus</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Post berhasil dihapus",
  "data": {}
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Post Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

    </div>
</section>
