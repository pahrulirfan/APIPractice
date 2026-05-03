<section id="penyakit" class="mb-5">
    <h2 class="h4 fw-bold">Penyakit <small class="text-muted">🔒</small></h2>
    <p class="text-muted">Endpoint untuk mengelola data penyakit. Semua endpoint memerlukan autentikasi Bearer token.</p>
    <hr>

    <div class="accordion shadow-sm" id="accordion-penyakit">

        {{-- GET /api/penyakit --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#penyakit-index">
                    <strong class="text-primary me-2">GET</strong>
                    <small class="text-muted me-2">🔒</small>
                    <code class="me-2">/api/penyakit</code>
                    <span class="text-muted small">— Daftar semua penyakit</span>
                </button>
            </h2>
            <div id="penyakit-index" class="accordion-collapse collapse" data-bs-parent="#accordion-penyakit">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data penyakit ditemukan",
  "data": [
    {
      "id": 1,
      "kode_icd": "A00",
      "nama": "Kolera",
      "deskripsi": "Infeksi usus akut yang disebabkan bakteri Vibrio cholerae",
      "kategori": "Infeksi",
      "created_at": "2024-01-01T00:00:00.000000Z",
      "updated_at": "2024-01-01T00:00:00.000000Z"
    }
  ]
}</code></pre>
                </div>
            </div>
        </div>

        {{-- GET /api/penyakit/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#penyakit-show">
                    <strong class="text-primary me-2">GET</strong>
                    <small class="text-muted me-2">🔒</small>
                    <code class="me-2">/api/penyakit/{id}</code>
                    <span class="text-muted small">— Detail penyakit + daftar pasien</span>
                </button>
            </h2>
            <div id="penyakit-show" class="accordion-collapse collapse" data-bs-parent="#accordion-penyakit">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data penyakit ditemukan",
  "data": {
    "id": 1,
    "kode_icd": "A00",
    "nama": "Kolera",
    "deskripsi": "Infeksi usus akut yang disebabkan bakteri Vibrio cholerae",
    "kategori": "Infeksi",
    "pasien": [
      {
        "id": 1,
        "nama": "Budi Santoso",
        "tanggal_lahir": "1990-05-15",
        "jenis_kelamin": "L",
        "alamat": "Jl. Merdeka No. 1",
        "no_telepon": "081234567890"
      }
    ]
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Penyakit Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- POST /api/penyakit --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#penyakit-store">
                    <strong class="text-success me-2">POST</strong>
                    <small class="text-muted me-2">🔒</small>
                    <code class="me-2">/api/penyakit</code>
                    <span class="text-muted small">— Buat penyakit baru</span>
                </button>
            </h2>
            <div id="penyakit-store" class="accordion-collapse collapse" data-bs-parent="#accordion-penyakit">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "kode_icd": "A00",
  "nama": "Kolera",
  "deskripsi": "Infeksi usus akut yang disebabkan bakteri Vibrio cholerae",
  "kategori": "Infeksi"
}</code></pre>
                    <p class="text-muted small mt-2">Field <code>deskripsi</code> opsional. Field <code>kode_icd</code> harus unik.</p>

                    <h6 class="fw-semibold mt-3">Response 201 — Berhasil Dibuat</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Penyakit berhasil dibuat",
  "data": {
    "id": 1,
    "kode_icd": "A00",
    "nama": "Kolera",
    "deskripsi": "Infeksi usus akut yang disebabkan bakteri Vibrio cholerae",
    "kategori": "Infeksi",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 422 — Validasi Gagal</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak valid",
  "errors": {
    "kode_icd": ["The kode icd has already been taken."]
  }
}</code></pre>
                </div>
            </div>
        </div>

        {{-- PUT /api/penyakit/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#penyakit-update">
                    <strong class="text-warning me-2">PUT</strong>
                    <small class="text-muted me-2">🔒</small>
                    <code class="me-2">/api/penyakit/{id}</code>
                    <span class="text-muted small">— Update penyakit</span>
                </button>
            </h2>
            <div id="penyakit-update" class="accordion-collapse collapse" data-bs-parent="#accordion-penyakit">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "kode_icd": "A00",
  "nama": "Kolera (Diperbarui)",
  "deskripsi": "Deskripsi yang diperbarui",
  "kategori": "Infeksi Bakteri"
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil Diperbarui</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Penyakit berhasil diperbarui",
  "data": {
    "id": 1,
    "kode_icd": "A00",
    "nama": "Kolera (Diperbarui)",
    "deskripsi": "Deskripsi yang diperbarui",
    "kategori": "Infeksi Bakteri",
    "created_at": "2024-01-01T00:00:00.000000Z",
    "updated_at": "2024-01-01T00:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Penyakit Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- DELETE /api/penyakit/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#penyakit-destroy">
                    <strong class="text-danger me-2">DELETE</strong>
                    <small class="text-muted me-2">🔒</small>
                    <code class="me-2">/api/penyakit/{id}</code>
                    <span class="text-muted small">— Hapus penyakit + data diagnosa</span>
                </button>
            </h2>
            <div id="penyakit-destroy" class="accordion-collapse collapse" data-bs-parent="#accordion-penyakit">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>
                    <p class="text-muted small mt-2">Menghapus penyakit beserta semua data diagnosa terkait (cascade delete).</p>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil Dihapus</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Penyakit berhasil dihapus",
  "data": {}
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Penyakit Tidak Ditemukan</h6>
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
