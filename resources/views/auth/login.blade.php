<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Masuk dengan Google · Demo responsif</title>
  <!-- Google Font & Icon (Material Icons) untuk fleksibilitas -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
    }

    body {
      background: #f0f5fa;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    /* KARTU UTAMA – layout kolom responsif */
    .login-card {
      display: flex;
      flex-wrap: wrap;         /* penting: kolom akan turun di layar kecil */
      max-width: 1000px;
      width: 100%;
      min-height: 600px;
      background-color: #ffffff;
      border-radius: 2.5rem;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
      overflow: hidden;        /* sudut tetap melengkung */
      transition: all 0.2s ease;
    }

    /* BANNER KIRI – latar dengan visual menarik */
    .brand-banner {
      flex: 1 1 45%;           /* basis 45%, bisa mengecil */
      background: linear-gradient(145deg, #1e3c72 0%, #2a5298 100%);
      /* alternatif pattern halus */
      background-image: radial-gradient(circle at 30% 40%, rgba(255,255,255,0.08) 0%, transparent 30%),
                        linear-gradient(145deg, #0f2b4f, #1b3b6b);
      color: white;
      padding: 2.5rem 2rem;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: relative;
      isolation: isolate;
    }

    /* elemen dekoratif (abstrak) */
    .brand-banner::after {
      content: '';
      position: absolute;
      inset: 0;
      background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.1"><path fill="white" d="M20 30 Q 40 10 60 30 T 100 30 L 80 70 Q 60 90 40 70 T 0 70 Z" /></svg>');
      background-size: 200px;
      background-repeat: repeat;
      z-index: 0;
      pointer-events: none;
    }

    .banner-content {
      position: relative;
      z-index: 2;
    }

    .brand-icon {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 3rem;
    }

    .brand-icon span.material-icons {
      font-size: 2.4rem;
      color: #ffd966;
    }

    .brand-icon h2 {
      font-weight: 500;
      font-size: 1.7rem;
      letter-spacing: -0.5px;
      color: white;
    }

    .banner-quote {
      max-width: 320px;
    }

    .banner-quote h1 {
      font-size: 2.2rem;
      font-weight: 600;
      line-height: 1.2;
      margin-bottom: 1.5rem;
      text-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }

    .banner-quote p {
      font-size: 1.1rem;
      opacity: 0.9;
      margin-bottom: 2rem;
      display: flex;
      align-items: center;
      gap: 0.4rem;
    }

    .banner-quote p .material-icons {
      font-size: 1.3rem;
    }

    .testimonial {
      margin-top: 2rem;
      border-left: 3px solid #ffb347;
      padding-left: 1.2rem;
      background: rgba(255,255,255,0.05);
      border-radius: 0 1rem 1rem 0;
      padding: 1rem 1.2rem;
      backdrop-filter: blur(4px);
    }

    .testimonial .avatar {
      display: flex;
      align-items: center;
      gap: 0.7rem;
      margin-bottom: 0.5rem;
    }

    .avatar-circle {
      background: #6279a3;
      width: 32px;
      height: 32px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 500;
    }

    .testimonial p {
      font-size: 0.95rem;
      font-style: italic;
      opacity: 0.9;
    }

    /* KOLOM KANAN – login dengan Google */
    .login-section {
      flex: 1 1 45%;
      background: white;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2.5rem 1.8rem;
    }

    .login-container {
      width: 100%;
      max-width: 340px;
      margin: 0 auto;
      text-align: center;
    }

    .login-header {
      margin-bottom: 2.5rem;
    }

    .login-header .material-icons {
      font-size: 3rem;
      color: #4285f4;
      background: #e8f0fe;
      padding: 0.8rem;
      border-radius: 60%;
      margin-bottom: 1.2rem;
    }

    .login-header h3 {
      font-size: 1.9rem;
      font-weight: 600;
      color: #202124;
      margin-bottom: 0.3rem;
    }

    .login-header p {
      color: #5f6368;
      font-size: 0.95rem;
    }

    /* tombol Google sesuai panduan branding */
    .google-btn {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      width: 100%;
      background: white;
      border: 1px solid #dadce0;
      border-radius: 40px;
      padding: 13px 24px;
      font-size: 1.1rem;
      font-weight: 500;
      color: #3c4043;
      cursor: pointer;
      transition: background 0.2s, box-shadow 0.2s;
      box-shadow: 0 1px 2px rgba(0,0,0,0.05);
      margin: 2rem 0 1.8rem;
    }

    .google-btn:hover {
      background: #f8f9fa;
      border-color: #bdc1c6;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .google-btn:active {
      background: #f1f3f4;
    }

    .google-btn img {
      width: 22px;
      height: 22px;
    }

    /* catatan kaki */
    .legal-note {
      font-size: 0.75rem;
      color: #9aa0a6;
      margin-top: 2rem;
      line-height: 1.5;
    }

    .legal-note a {
      color: #4285f4;
      text-decoration: none;
    }

    .legal-note a:hover {
      text-decoration: underline;
    }

    /* divider dekoratif */
    .divider {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #dadce0;
      font-size: 0.8rem;
      margin: 1.2rem 0;
    }

    .divider-line {
      flex: 1;
      height: 1px;
      background: #e8eaed;
    }

    /* opsi lain? hanya menampilkan bahwa hanya google */
    .only-google {
      background: #f1f8e9;
      border-radius: 50px;
      padding: 0.5rem 1rem;
      color: #2e7d32;
      font-size: 0.85rem;
      display: inline-flex;
      align-items: center;
      gap: 4px;
      margin-top: 1rem;
    }

    /* RESPONSIVE: ketika layar kurang dari 700px, banner di atas */
    @media screen and (max-width: 700px) {
      .login-card {
        flex-direction: column;
        border-radius: 2rem;
        min-height: auto;
      }

      .brand-banner {
        padding: 2rem 1.8rem 1.5rem;
        border-radius: 0; 
        text-align: center;
      }

      .brand-icon {
        justify-content: center;
        margin-bottom: 1.5rem;
      }

      .banner-quote {
        max-width: 100%;
      }

      .banner-quote h1 {
        font-size: 1.9rem;
      }

      .testimonial {
        max-width: 360px;
        margin-left: auto;
        margin-right: auto;
      }

      .login-section {
        padding: 2rem 1.5rem;
      }

      .login-container {
        max-width: 360px;
      }
    }

    /* layar sangat kecil (hp kecil) */
    @media screen and (max-width: 400px) {
      .banner-quote h1 {
        font-size: 1.6rem;
      }

      .google-btn {
        padding: 11px 16px;
        font-size: 1rem;
      }

      .login-header h3 {
        font-size: 1.7rem;
      }
    }

    /* Hilangkan banner kiri jika terlalu sempit (opsional) tapi kita tetap tampil */
    /* fallback logo google dari svg inline (tanpa panggil eksternal) */
  </style>
</head>
<body>
  <div class="login-card">
    <!-- BANNER KIRI : gambar/ brand message -->
    <div class="brand-banner">
      <div class="banner-content">
        <div class="brand-icon">
          <img src="{{asset('landing_assets/images/logo/logo-light.png')}}" style="width: 150px" alt="logo">
        </div>
        <div class="banner-quote">
          <img src="{{asset('auth_assets/images/banner.png')}}" alt="">
        </div>
      </div>
    </div>

    <!-- KOLOM KANAN : login dengan Google -->
    <div class="login-section">
      <div class="login-container">
        <div class="login-header">
          <span class="material-icons">lock_open</span>
          <h3>Selamat datang</h3>
          <p>Gunakan akun Google untuk login</p>
        </div>

        <!-- TOMBOL GOOGLE (simulasi, hanya tampilan) -->
        <button class="google-btn" aria-label="Masuk dengan Google" id="googleLoginBtn">
          <!-- logo google sederhana (inline svg) -->
          <svg width="22" height="22" viewBox="0 0 24 24">
            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
          </svg>
          <span>Masuk dengan Google</span>
        </button>

        <!-- penjelasan bahwa hanya google, tanpa username/password -->
        <div class="divider">
          <span class="divider-line"></span>
          <span class="only-google">
            <span class="material-icons" style="font-size: 1rem;">verified_user</span> hanya dengan Google
          </span>
          <span class="divider-line"></span>
        </div>

        <div class="legal-note">
          Dengan melanjutkan, Anda menyetujui <a href="#">Ketentuan Layanan</a> dan <a href="#">Kebijakan Privasi</a>.<br>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function() {
      // Hanya untuk memberikan umpan balik visual saat tombol diklik
      const googleBtn = document.getElementById('googleLoginBtn');
      if (googleBtn) {
        googleBtn.addEventListener('click', function(e) {
          e.preventDefault();
          // Simulasi notifikasi (hanya demo, tidak redirect)
          alert('[Demo] Tombol "Masuk dengan Google" ditekan. Di sini Anda akan diarahkan ke OAuth Google.');
        });
      }

      // opsional: tambahkan efek kecil untuk menunjukkan responsif
      window.addEventListener('resize', function() {
        // bisa diabaikan
      });
    })();
  </script>

  <!-- Catatan: form ini tidak mengirim kredensial, hanya ilustrasi UI -->
  <!-- untuk integrasi sungguhan, ganti button dengan link ke backend OAuth -->
</body>
</html>