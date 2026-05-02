<section id="diagnosa" class="mb-5">
    <h2 class="h4 fw-bold">Diagnosa <span class="badge bg-warning text-dark">PROTECTED</span></h2>
    <p class="text-muted">Endpoint untuk mengelola relasi diagnosa antara Pasien dan Penyakit. Semua endpoint memerlukan autentikasi Bearer token.</p>
    <hr>

    <div class="accordion shadow-sm" id="accordion-diagnosa">

        {{-- POST /api/pasien/{id}/diagnosa --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#diagnosa-store">
                    <span class="badge bg-success me-2">POST</span>
                    <span class="badge bg-warning text-dark me-2">PROTECTED</span>
                    <code class="me-2">/api/pasien/{id}/diagnosa</code>
                    <span class="text-muted small">— Tambah diagnosa ke pasien</span>
                </button>
            </h2>
            <div id="diagnosa-store" class="accordion-collapse collapse" data-bs-parent="#accordion-diagnosa">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "penyakit_id": [1, 2]
}</code></pre>
                    <p class="text-muted small mt-2">
                        Array ID penyakit yang akan ditambahkan. Operasi bersifat idempotent — ID yang sudah ada tidak akan duplikat.
                    </p>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Diagnosa berhasil ditambahkan",
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
      },
      {
        "id": 2,
        "kode_icd": "B01",
        "nama": "Cacar Air",
        "deskripsi": "Infeksi virus varicella",
        "kategori": "Infeksi Virus"
      }
    ]
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 422 — Validasi Gagal</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Data tidak valid",
  "errors": {
    "penyakit_id.0": ["The selected penyakit_id.0 is invalid."]
  }
}</code></pre>
                </div>
            </div>
        </div>

        {{-- DELETE /api/pasien/{id}/diagnosa/{penyakit_id} --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#diagnosa-destroy">
                    <span class="badge bg-danger me-2">DELETE</span>
                    <span class="badge bg-warning text-dark me-2">PROTECTED</span>
                    <code class="me-2">/api/pasien/{id}/diagnosa/{penyakit_id}</code>
                    <span class="text-muted small">— Hapus diagnosa dari pasien</span>
                </button>
            </h2>
            <div id="diagnosa-destroy" class="accordion-collapse collapse" data-bs-parent="#accordion-diagnosa">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>
                    <p class="text-muted small mt-2">
                        <code>{id}</code> = ID pasien, <code>{penyakit_id}</code> = ID penyakit yang akan dihapus dari diagnosa.
                    </p>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil Dihapus</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Diagnosa berhasil dihapus",
  "data": {}
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 404 — Relasi Tidak Ditemukan</h6>
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
