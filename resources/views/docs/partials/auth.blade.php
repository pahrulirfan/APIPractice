<section id="auth" class="mb-5">
    <h2 class="h4 fw-bold">Autentikasi <span class="badge bg-success">PUBLIC</span></h2>
    <p class="text-muted">Endpoint untuk login dan logout pengguna menggunakan Laravel Sanctum.</p>
    <hr>

    <div class="accordion shadow-sm" id="accordion-auth">

        {{-- POST /api/login --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#auth-login">
                    <span class="badge bg-success me-2">POST</span>
                    <span class="badge bg-success me-2">PUBLIC</span>
                    <code class="me-2">/api/login</code>
                    <span class="text-muted small">— Login dan dapatkan token</span>
                </button>
            </h2>
            <div id="auth-login" class="accordion-collapse collapse" data-bs-parent="#accordion-auth">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Body</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "email": "admin@example.com",
  "password": "password"
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Login berhasil",
  "data": {
    "token": "1|abc123...",
    "user": {
      "id": 1,
      "name": "Admin",
      "email": "admin@example.com",
      "role": "admin",
      "is_active": true
    }
  }
}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 401 — Kredensial Salah</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": false,
  "message": "Email atau password salah",
  "errors": {}
}</code></pre>
                </div>
            </div>
        </div>

        {{-- POST /api/logout --}}
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#auth-logout">
                    <span class="badge bg-success me-2">POST</span>
                    <span class="badge bg-warning text-dark me-2">PROTECTED</span>
                    <code class="me-2">/api/logout</code>
                    <span class="text-muted small">— Logout dan cabut token</span>
                </button>
            </h2>
            <div id="auth-logout" class="accordion-collapse collapse" data-bs-parent="#accordion-auth">
                <div class="accordion-body">
                    <h6 class="fw-semibold">Request Header</h6>
                    <pre><code class="bg-light p-3 rounded d-block">Authorization: Bearer {token}</code></pre>

                    <h6 class="fw-semibold mt-3">Response 200 — Berhasil</h6>
                    <pre><code class="bg-light p-3 rounded d-block">{
  "success": true,
  "message": "Logout berhasil",
  "data": {}
}</code></pre>
                </div>
            </div>
        </div>

    </div>
</section>
