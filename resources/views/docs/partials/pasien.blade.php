<section id="pasien" class="mb-5">
    <h2 class="h4 fw-bold">Pasien <small class="text-muted">🔒</small></h2>
    <p class="text-muted">Endpoint untuk mengelola data pasien. Semua endpoint memerlukan autentikasi Bearer token.</p>
    <hr>

    <div class="accordion shadow-sm" id="accordion-pasien">

        {{-- GET /api/pasien --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pasien-index">
                    <strong class="text-primary me-2">GET</strong>
                    <small class="text-muted me-2">🔒</small>
                    <code class="me-2">/api/pasien</code>
                    <span class="text-muted small">— Daftar semua pasien</span>
                </button>
            </h2>
            <div id="pasien-index" class="accordion-collapse collapse" data-bs-parent="#accordion-pasien">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data pasien ditemukan",
  "data": [
    {
      "id": 1,
      "nama": "Budi Santoso",
      "tanggal_lahir": "1990-05-15",
      "jenis_kelamin": "L",
      "alamat": "Jl. Merdeka No. 1",
      "no_telepon": "081234567890",
      "created_at": "2024-01-01T00:00:00.000000Z",
      "updated_at": "2024-01-01T00:00:00.000000Z"
    }
  ]
}</code></pre>
                </div>
            </div>
        </div>

        {{-- GET /api/pasien/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pasien-show">
                    <strong class="text-primary me-2">GET</strong>
                    <small class="text-muted me-2">🔒</small>
                    <code class="me-2">/api/pasien/{id}</code>
                    <span class="text-muted small">— Detail pasien + daftar penyakit</span>
                </button>
            </h2>
            <div id="pasien-show" class="accordion-collapse collapse" data-bs-parent="#accordion-pasien">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data pasien ditemukan",
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
        "deskripsi": "Infeksi usus akut",
        "kategori": "Infeksi"
      }
    ]
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Pasien Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- POST /api/pasien --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pasien-store">
                    <strong class="text-success me-2">POST</strong>
                    <small class="text-muted me-2">🔒</small>
                    <code class="me-2">/api/pasien</code>
                    <span class="text-muted small">— Buat pasien baru</span>
                </button>
            </h2>
            <div id="pasien-store" class="accordion-collapse collapse" data-bs-parent="#accordion-pasien">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "nama": "Budi Santoso",
  "tanggal_lahir": "1990-05-15",
  "jenis_kelamin": "L",
  "alamat": "Jl. Merdeka No. 1",
  "no_telepon": "081234567890"
}</code></pre>
                    <p class="text-muted small mt-2"><code>jenis_kelamin</code> hanya menerima: <code>L</code> (Laki-laki) atau <code>P</code> (Perempuan).</p>

                    <h6 class="fw-semibold mt-3">Response 201 — Berhasil Dibuat</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Pasien berhasil dibuat",
  "data": {
    "id": 1,
    "nama": "Budi Santoso",
    "tanggal_lahir": "1990-05-15",
    "jenis_kelamin": "L",
    "alamat": "Jl. Merdeka No. 1",
    "no_telepon": "081234567890",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 422 — Validasi Gagal</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak valid",
  "errors": {
    "nama": ["The nama field is required."],
    "jenis_kelamin": ["The selected jenis kelamin is invalid."]
  }
}</code></pre>
                </div>
            </div>
        </div>

        {{-- PUT /api/pasien/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pasien-update">
                    <strong class="text-warning me-2">PUT</strong>
                    <small class="text-muted me-2">🔒</small>
                    <code class="me-2">/api/pasien/{id}</code>
                    <span class="text-muted small">— Update pasien</span>
                </button>
            </h2>
            <div id="pasien-update" class="accordion-collapse collapse" data-bs-parent="#accordion-pasien">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "nama": "Budi Santoso Diperbarui",
  "tanggal_lahir": "1990-05-15",
  "jenis_kelamin": "L",
  "alamat": "Jl. Baru No. 5",
  "no_telepon": "089876543210"
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil Diperbarui</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Pasien berhasil diperbarui",
  "data": {
    "id": 1,
    "nama": "Budi Santoso Diperbarui",
    "tanggal_lahir": "1990-05-15",
    "jenis_kelamin": "L",
    "alamat": "Jl. Baru No. 5",
    "no_telepon": "089876543210",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Pasien Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- DELETE /api/pasien/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pasien-destroy">
                    <strong class="text-danger me-2">DELETE</strong>
                    <small class="text-muted me-2">🔒</small>
                    <code class="me-2">/api/pasien/{id}</code>
                    <span class="text-muted small">— Hapus pasien + data diagnosa</span>
                </button>
            </h2>
            <div id="pasien-destroy" class="accordion-collapse collapse" data-bs-parent="#accordion-pasien">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>
                    <p class="text-muted small mt-2">Menghapus pasien beserta semua data diagnosa terkait (cascade delete).</p>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil Dihapus</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Pasien berhasil dihapus",
  "data": {}
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Pasien Tidak Ditemukan</h6>
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
