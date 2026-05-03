<section id="medicines" class="mb-5">
    <h2 class="h4 fw-bold">Medicine </h2>
    <p class="text-muted">Endpoint untuk mengelola data medicine. Semua endpoint bersifat publik dan tidak memerlukan autentikasi.</p>
    <hr>

    <div class="accordion shadow-sm" id="accordion-medicines">

        {{-- GET /api/medicines --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#medicines-index">
                    <strong class="text-primary me-2">GET</strong>
                    <code class="me-2">/api/medicines</code>
                    <span class="text-muted small">— Daftar semua medicine</span>
                </button>
            </h2>
            <div id="medicines-index" class="accordion-collapse collapse" data-bs-parent="#accordion-medicines">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data medicine ditemukan",
  "data": [
    {
      "id": 1,
      "name": "Paracetamol",
      "brand": "Panadol",
      "manufacturer": "GlaxoSmithKline",
      "created_at": "2026-04-30T10:00:00.000000Z",
      "updated_at": "2026-04-30T10:00:00.000000Z"
    }
  ]
}</code></pre>
                </div>
            </div>
        </div>

        {{-- GET /api/medicines/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#medicines-show">
                    <strong class="text-primary me-2">GET</strong>
                    <code class="me-2">/api/medicines/{id}</code>
                    <span class="text-muted small">— Detail medicine</span>
                </button>
            </h2>
            <div id="medicines-show" class="accordion-collapse collapse" data-bs-parent="#accordion-medicines">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data medicine ditemukan",
  "data": {
    "id": 1,
    "name": "Paracetamol",
    "brand": "Panadol",
    "manufacturer": "GlaxoSmithKline",
    "created_at": "2026-04-30T10:00:00.000000Z",
    "updated_at": "2026-04-30T10:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Medicine Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- POST /api/medicines --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#medicines-store">
                    <strong class="text-success me-2">POST</strong>
                    <code class="me-2">/api/medicines</code>
                    <span class="text-muted small">— Buat medicine baru</span>
                </button>
            </h2>
            <div id="medicines-store" class="accordion-collapse collapse" data-bs-parent="#accordion-medicines">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "name": "Paracetamol",
  "brand": "Panadol",
  "manufacturer": "GlaxoSmithKline"
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 201 — Berhasil Dibuat</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Medicine berhasil dibuat",
  "data": {
    "id": 1,
    "name": "Paracetamol",
    "brand": "Panadol",
    "manufacturer": "GlaxoSmithKline",
    "created_at": "2026-04-30T10:00:00.000000Z",
    "updated_at": "2026-04-30T10:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 422 — Validasi Gagal</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak valid",
  "errors": {
    "name": ["The name field is required."],
    "brand": ["The brand field is required."]
  }
}</code></pre>
                </div>
            </div>
        </div>

        {{-- PUT /api/medicines/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#medicines-update">
                    <strong class="text-warning me-2">PUT</strong>
                    <code class="me-2">/api/medicines/{id}</code>
                    <span class="text-muted small">— Update medicine</span>
                </button>
            </h2>
            <div id="medicines-update" class="accordion-collapse collapse" data-bs-parent="#accordion-medicines">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "name": "Ibuprofen",
  "brand": "Proris",
  "manufacturer": "Tempo Scan Pacific"
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil Diperbarui</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Medicine berhasil diperbarui",
  "data": {
    "id": 1,
    "name": "Ibuprofen",
    "brand": "Proris",
    "manufacturer": "Tempo Scan Pacific",
    "created_at": "2026-04-30T10:00:00.000000Z",
    "updated_at": "2026-04-30T10:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Medicine Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- DELETE /api/medicines/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#medicines-destroy">
                    <strong class="text-danger me-2">DELETE</strong>
                    <code class="me-2">/api/medicines/{id}</code>
                    <span class="text-muted small">— Hapus medicine</span>
                </button>
            </h2>
            <div id="medicines-destroy" class="accordion-collapse collapse" data-bs-parent="#accordion-medicines">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Response 200 — Berhasil Dihapus</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Medicine berhasil dihapus",
  "data": {}
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Medicine Tidak Ditemukan</h6>
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
