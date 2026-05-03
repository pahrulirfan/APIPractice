<section id="comments" class="mb-5">
    <h2 class="h4 fw-bold">Comment </h2>
    <p class="text-muted">Endpoint untuk mengelola data comment. Semua endpoint bersifat publik dan tidak memerlukan autentikasi.</p>
    <hr>

    <div class="accordion shadow-sm" id="accordion-comments">

        {{-- GET /api/comments --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#comments-index">
                    <strong class="text-primary me-2">GET</strong>
                    <code class="me-2">/api/comments</code>
                    <span class="text-muted small">— Daftar semua comment</span>
                </button>
            </h2>
            <div id="comments-index" class="accordion-collapse collapse" data-bs-parent="#accordion-comments">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data comment ditemukan",
  "data": [
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
}</code></pre>
                </div>
            </div>
        </div>

        {{-- GET /api/comments/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#comments-show">
                    <strong class="text-primary me-2">GET</strong>
                    <code class="me-2">/api/comments/{id}</code>
                    <span class="text-muted small">— Detail comment + post terkait</span>
                </button>
            </h2>
            <div id="comments-show" class="accordion-collapse collapse" data-bs-parent="#accordion-comments">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data comment ditemukan",
  "data": {
    "id": 1,
    "post_id": 1,
    "name": "Komentator",
    "email": "komentar@example.com",
    "body": "Isi komentar",
    "status": "approved",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z",
    "post": {
      "id": 1,
      "title": "Judul Post",
      "body": "Isi konten post...",
      "author": "Nama Penulis",
      "slug": "judul-post",
      "status": "published"
    }
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Comment Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- GET /api/posts/{id}/comments --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#comments-by-post">
                    <strong class="text-primary me-2">GET</strong>
                    <code class="me-2">/api/posts/{id}/comments</code>
                    <span class="text-muted small">— Comments milik post tertentu</span>
                </button>
            </h2>
            <div id="comments-by-post" class="accordion-collapse collapse" data-bs-parent="#accordion-comments">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data comment ditemukan",
  "data": [
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

        {{-- POST /api/comments --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#comments-store">
                    <strong class="text-success me-2">POST</strong>
                    <code class="me-2">/api/comments</code>
                    <span class="text-muted small">— Buat comment baru</span>
                </button>
            </h2>
            <div id="comments-store" class="accordion-collapse collapse" data-bs-parent="#accordion-comments">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "post_id": 1,
  "name": "Komentator",
  "email": "komentar@example.com",
  "body": "Isi komentar",
  "status": "pending"
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 201 — Berhasil Dibuat</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Comment berhasil dibuat",
  "data": {
    "id": 1,
    "post_id": 1,
    "name": "Komentator",
    "email": "komentar@example.com",
    "body": "Isi komentar",
    "status": "pending",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 422 — Validasi Gagal</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak valid",
  "errors": {
    "post_id": ["The selected post id is invalid."],
    "body": ["The body field is required."]
  }
}</code></pre>
                </div>
            </div>
        </div>

        {{-- PUT /api/comments/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#comments-update">
                    <strong class="text-warning me-2">PUT</strong>
                    <code class="me-2">/api/comments/{id}</code>
                    <span class="text-muted small">— Update comment</span>
                </button>
            </h2>
            <div id="comments-update" class="accordion-collapse collapse" data-bs-parent="#accordion-comments">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "name": "Komentator Diperbarui",
  "email": "baru@example.com",
  "body": "Isi komentar yang diperbarui",
  "status": "approved"
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil Diperbarui</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Comment berhasil diperbarui",
  "data": {
    "id": 1,
    "post_id": 1,
    "name": "Komentator Diperbarui",
    "email": "baru@example.com",
    "body": "Isi komentar yang diperbarui",
    "status": "approved",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Comment Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- DELETE /api/comments/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#comments-destroy">
                    <strong class="text-danger me-2">DELETE</strong>
                    <code class="me-2">/api/comments/{id}</code>
                    <span class="text-muted small">— Hapus comment</span>
                </button>
            </h2>
            <div id="comments-destroy" class="accordion-collapse collapse" data-bs-parent="#accordion-comments">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Response 200 — Berhasil Dihapus</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Comment berhasil dihapus",
  "data": {}
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Comment Tidak Ditemukan</h6>
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
