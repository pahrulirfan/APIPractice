<section id="vehicles" class="mb-5">
    <h2 class="h4 fw-bold">Vehicle </h2>
    <p class="text-muted">Endpoint untuk mengelola data vehicle. Semua endpoint bersifat publik dan tidak memerlukan autentikasi.</p>
    <hr>

    <div class="accordion shadow-sm" id="accordion-vehicles">

        {{-- GET /api/vehicles --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#vehicles-index">
                    <strong class="text-primary me-2">GET</strong>
                    <code class="me-2">/api/vehicles</code>
                    <span class="text-muted small">— Daftar semua vehicle</span>
                </button>
            </h2>
            <div id="vehicles-index" class="accordion-collapse collapse" data-bs-parent="#accordion-vehicles">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data vehicle ditemukan",
  "data": [
    {
      "id": 1,
      "model": "Civic",
      "type": "Sedan",
      "manufacturer": "Honda",
      "created_at": "2026-04-30T10:00:00.000000Z",
      "updated_at": "2026-04-30T10:00:00.000000Z"
    }
  ]
}</code></pre>
                </div>
            </div>
        </div>

        {{-- GET /api/vehicles/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#vehicles-show">
                    <strong class="text-primary me-2">GET</strong>
                    <code class="me-2">/api/vehicles/{id}</code>
                    <span class="text-muted small">— Detail vehicle</span>
                </button>
            </h2>
            <div id="vehicles-show" class="accordion-collapse collapse" data-bs-parent="#accordion-vehicles">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Data vehicle ditemukan",
  "data": {
    "id": 1,
    "model": "Civic",
    "type": "Sedan",
    "manufacturer": "Honda",
    "created_at": "2026-04-30T10:00:00.000000Z",
    "updated_at": "2026-04-30T10:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Vehicle Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- POST /api/vehicles --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#vehicles-store">
                    <strong class="text-success me-2">POST</strong>
                    <code class="me-2">/api/vehicles</code>
                    <span class="text-muted small">— Buat vehicle baru</span>
                </button>
            </h2>
            <div id="vehicles-store" class="accordion-collapse collapse" data-bs-parent="#accordion-vehicles">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "model": "Civic",
  "type": "Sedan",
  "manufacturer": "Honda"
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 201 — Berhasil Dibuat</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Vehicle berhasil dibuat",
  "data": {
    "id": 1,
    "model": "Civic",
    "type": "Sedan",
    "manufacturer": "Honda",
    "created_at": "2026-04-30T10:00:00.000000Z",
    "updated_at": "2026-04-30T10:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 422 — Validasi Gagal</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak valid",
  "errors": {
    "model": ["The model field is required."],
    "type": ["The type field is required."]
  }
}</code></pre>
                </div>
            </div>
        </div>

        {{-- PUT /api/vehicles/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#vehicles-update">
                    <strong class="text-warning me-2">PUT</strong>
                    <code class="me-2">/api/vehicles/{id}</code>
                    <span class="text-muted small">— Update vehicle</span>
                </button>
            </h2>
            <div id="vehicles-update" class="accordion-collapse collapse" data-bs-parent="#accordion-vehicles">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "model": "Accord",
  "type": "Sedan",
  "manufacturer": "Honda"
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil Diperbarui</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Vehicle berhasil diperbarui",
  "data": {
    "id": 1,
    "model": "Accord",
    "type": "Sedan",
    "manufacturer": "Honda",
    "created_at": "2026-04-30T10:00:00.000000Z",
    "updated_at": "2026-04-30T10:00:00.000000Z"
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Vehicle Tidak Ditemukan</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak ditemukan",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- DELETE /api/vehicles/{id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#vehicles-destroy">
                    <strong class="text-danger me-2">DELETE</strong>
                    <code class="me-2">/api/vehicles/{id}</code>
                    <span class="text-muted small">— Hapus vehicle</span>
                </button>
            </h2>
            <div id="vehicles-destroy" class="accordion-collapse collapse" data-bs-parent="#vehicles-destroy">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Response 200 — Berhasil Dihapus</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Vehicle berhasil dihapus",
  "data": {}
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Vehicle Tidak Ditemukan</h6>
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
