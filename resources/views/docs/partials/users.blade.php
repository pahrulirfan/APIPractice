<section id="users" class="mb-5">
    <h2 class="h4 fw-bold">User <span class="badge bg-warning text-dark">PROTECTED</span></h2>
    <p class="text-muted">Endpoint untuk mengelola data user. Semua endpoint memerlukan autentikasi Bearer token.</p>
    <hr>

    <div class="accordion shadow-sm" id="accordion-users">

        {{-- GET /api/users --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#users-index">
                    <span class="badge bg-primary me-2">GET</span>
                    <span class="badge bg-warning text-dark me-2">PROTECTED</span>
                    <code class="me-2">/api/users</code>
                    <span class="text-muted small">— Daftar semua user</span>
                </button>
            </h2>
            <div id="users-index" class="accordion-collapse collapse" data-bs-parent="#accordion-users">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data user ditemukan",
  "data": [
    {
      "id": 1,
      "name": "Admin",
      "email": "admin@example.com",
      "role": "admin",
      "is_active": true,
      "created_at": "2024-01-01T00:00:00.000000Z",
      "updated_at": "2024-01-01T00:00:00.000000Z"
    }
  ]
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 401 — Tidak Terautentikasi</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Unauthenticated",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- GET /api/users/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#users-show">
                    <span class="badge bg-primary me-2">GET</span>
                    <span class="badge bg-warning text-dark me-2">PROTECTED</span>
                    <code class="me-2">/api/users/{id}</code>
                    <span class="text-muted small">— Detail user</span>
                </button>
            </h2>
            <div id="users-show" class="accordion-collapse collapse" data-bs-parent="#accordion-users">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data user ditemukan",
  "data": {
    "id": 1,
    "name": "Admin",
    "email": "admin@example.com",
    "role": "admin",
    "is_active": true,
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — User Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- POST /api/users --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#users-store">
                    <span class="badge bg-success me-2">POST</span>
                    <span class="badge bg-warning text-dark me-2">PROTECTED</span>
                    <code class="me-2">/api/users</code>
                    <span class="text-muted small">— Buat user baru</span>
                </button>
            </h2>
            <div id="users-store" class="accordion-collapse collapse" data-bs-parent="#accordion-users">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "name": "User Baru",
  "email": "user@example.com",
  "password": "password123",
  "role": "user",
  "is_active": true
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 201 — Berhasil Dibuat</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "User berhasil dibuat",
  "data": {
    "id": 2,
    "name": "User Baru",
    "email": "user@example.com",
    "role": "user",
    "is_active": true,
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 422 — Validasi Gagal</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak valid",
  "errors": {
    "email": ["The email has already been taken."],
    "password": ["The password field must be at least 8 characters."]
  }
}</code></pre>
                </div>
            </div>
        </div>

        {{-- PUT /api/users/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#users-update">
                    <span class="badge bg-warning text-dark me-2">PUT</span>
                    <span class="badge bg-warning text-dark me-2">PROTECTED</span>
                    <code class="me-2">/api/users/{id}</code>
                    <span class="text-muted small">— Update user</span>
                </button>
            </h2>
            <div id="users-update" class="accordion-collapse collapse" data-bs-parent="#accordion-users">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "name": "User Diperbarui",
  "email": "user@example.com",
  "password": "newpassword123",
  "role": "admin",
  "is_active": false
}</code></pre>
                    <p class="text-muted small mt-2">Field <code>password</code> bersifat opsional saat update.</p>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil Diperbarui</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "User berhasil diperbarui",
  "data": {
    "id": 2,
    "name": "User Diperbarui",
    "email": "user@example.com",
    "role": "admin",
    "is_active": false,
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — User Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- DELETE /api/users/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#users-destroy">
                    <span class="badge bg-danger me-2">DELETE</span>
                    <span class="badge bg-warning text-dark me-2">PROTECTED</span>
                    <code class="me-2">/api/users/{id}</code>
                    <span class="text-muted small">— Hapus user</span>
                </button>
            </h2>
            <div id="users-destroy" class="accordion-collapse collapse" data-bs-parent="#accordion-users">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil Dihapus</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "User berhasil dihapus",
  "data": {}
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — User Tidak Ditemukan</h6>
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
