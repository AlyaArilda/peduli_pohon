<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Indonesia Forest</title>
    <link rel="stylesheet" href="{{asset('asset/css/style.css')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Nunito:wght@400;700&display=swap"
      rel="stylesheet"
    />
    <link rel="icon" href="assets/Frame 45.png" type="image/png" />
  </head>

  <body>
    <!-- NAVBAR -->
    <header class="navbar">
      <div class="navbar-container">
        <div class="logo">
          <img src="{{asset('asset/assets/Frame 45.png')}}" alt="Logo Peduli Pohon" />
        </div>

        <ul class="nav-links" id="navLinks">
          <li><a href="#tentang">Tentang Kami</a></li>
          <li><a href="#fitur-kami">Fitur Kami</a></li>
          <li><a href="#kontak">Kontak</a></li>
        </ul>

        <div class="hamburger" onclick="toggleMenu()">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </header>

    <!-- SECTION SATU -->
    <section class="hero">
      <div class="overlay"></div>
      <div class="hero-content">
        <h1>Tanam Kebaikan, Rawat Bumi dari Genggamanmu</h1>
        <p>
          Adopsi satu pohon, selamatkan masa depan. Pantau dan rawat pohonmu
          dengan aplikasi kami.
        </p>
        <a href="#" class="cta-button"> Download Sekarang</a>
      </div>
    </section>

    <!-- TENTANG,GAMBAR KIRI & VISI MISI -->
    <section class="about" id="tentang">
      <h2 class="section-title">Tentang Kami</h2>

      <div class="about-wrapper">
        <!-- Text content on the left -->
        <div class="about-content">
          <p class="about-headline">
            Mari tumbuh bersama — satu <br />pohon, satu harapan.
          </p>
          <p class="ais">
           <span> Kami percaya bahwa setiap orang punya peran</span> 
           <span>untuk menjaga bumi.</span>
            <span>Melalui aplikasi Adopsi Pohon Digital, kami</span>
             <span>menghubungkan kamu dengan pohon-pohon</span> 
             <span>yang membutuhkan perawatan dan dukungan.</span>
            <span>Dengan sistem adopsi yang transparan dan</span> 
            <span>mudah diakses, siapa pun kini bisa ikut</span>
             <span>berkontribusi dalam menjaga kelestarian alam —</span> 
             <span>kapan
            saja, di mana saja.</span>
          </p>

          <div class="vision-mission">
            <div class="visi">
              <h3>Visi</h3>
              <p>
                Menjadi jembatan digital <br />bagi generasi peduli
                <br />lingkungan dalam <br />
                melestarikan bumi melalui <br />
                aksi nyata adopsi pohon.
              </p>
            </div>
            <div class="misi">
              <h3>Misi</h3>
              <ol>
                <li>Mempermudah adopsi dan perawatan pohon secara digital.</li>
                <li>Mendukung komunitas lokal dan pelestarian  lingkungan.</li>
                <li>
                  Meningkatkan kesadaran dan edukasi tentang pentingnya pohon.
                </li>
              </ol>
            </div>
          </div>
        </div>

        <!-- Image -->
        <div class="about-image">
          <img src="{{asset('asset/assets/Pinterest.png')}}" alt="Menanam pohon" />
        </div>
      </div>
    </section>

    <!-- FITUR FITURNYA -->
    <section class="features" id="fitur-kami">
      <div class="container">
        <h2 class="section-title">Fitur kami</h2>
        <div class="feature-grid">
          <div class="feature-item">
            <img src="{{asset('asset/assets/fitur/icon-park_tree-two.png')}}" alt="Adopsi Pohon" />
            <h2>Adopsi Pohon Online</h2>
            <p>
              Pilih pohon yang ingin kamu adopsi berdasarkan lokasi, jenis, dan
              kebutuhan perawatan.
            </p>
          </div>

          <div class="feature-item">
            <img
              src="{{asset('asset/assets/fitur/mingcute_service-line.png')}}"
              alt="Laporan Kerusakan Pohon"
            />
            <h2>Laporan Kerusakan Pohon</h2>
            <p>
              Laporin kondisi pohon yang rusak <br />atau butuh perhatian lebih
              melalui <br />
              aplikasi.
            </p>
          </div>

          <div class="feature-item">
            <img
              src="{{asset('asset/assets/fitur/lucide_book-marked.png')}}"
              alt="Edukasi Peduli Lingkungan"
            />
            <h2>Edukasi Peduli Lingkungan</h2>
            <p>
              Pelajari cara merawat tanaman, menjaga lingkungan, dan berbagai
              makanan secara bijak — semua dalam genggaman Anda.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION TERAKHIR YANG ADA HP NYA -->
    <section class="cta-section" id="kontak">
      <div class="cta-container">
        <div class="cta-left">
          <h2 class="cta-heading">
            Yuk, mulai langkah kecil untuk dampak besar hari ini 🌱
          </h2>
          <p class="cta-desc">
            Gabung dalam gerakan hijau untuk bumi yang lebih lestari! <br />
            Adopsi, rawat, dan pantau pohon langsung dari <br> genggamanmu.
          </p>
        </div>
        <div class="gambar_hp">
          <img src="{{asset('asset/assets/iphone.png')}}" alt="hp" />
        </div>
        <!-- <div class="cta-right">
          <p>Dapatkan aplikasi kami di:</p>
          <div class="store-buttons">
            <a href="#" class="store-button">
              <img src="assets/Google Play logo.png" alt="Google Play Logo" />
              <div class="store-text">
                <span class="small-text">GET IT ON</span><br />
                <span class="store-name">Google Play</span>
              </div>
            </a>
            <a href="#" class="store-button">
              <img src="assets/_Group_.png" alt="Apple Logo" />
              <div class="store-text">
                <span class="small-text">Download on the</span><br />
                <span class="store-name">App Store</span>
              </div>
            </a>
          </div>
        </div> -->
      </div>
    </section>

    <!-- KALO INI FOOTER YANG TERAKHIR -->
    <footer class="footer-section">
      <div class="footer-container">
        <div class="footer-left">
          <p class="footer-brand">Bersama, Kita <br />Hijaukan Dunia</p>
          <div class="social-icons">
            <a href="https://www.linkedin.com/in/alya-arilda-b9737a317?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app
                    " class="social-icon">
              <img src="{{asset('asset/assets/Img.png')}}" alt="LinkedIn" />
            </a>
            <a href="https://www.instagram.com/allyaa.la?igsh=enptdGdxd3M5ZnI5" class="social-icon">
              <img src="{{asset('asset/assets/Img (1).png')}}" alt="Instagram" />
            </a>
            <a href="https://www.facebook.com/share/191Y39aYsE/" class="social-icon">
              <img src="{{asset('asset/assets/Img (2).png')}}" alt="Facebook" />
            </a>
            <a href="https://youtube.com/@alyaaaaarilda?si=8rws9ln2GuYPTo5i" class="social-icon">
              <img src="{{asset('asset/assets/Img (3).png')}}" alt="YouTube" />
            </a>
          </div>
        </div>
        <div class="footer-right">
          <p class="footer-nav-title">NAVIGASI</p>
          <ul class="footer-nav">
            <li><a href="#tentang">Beranda</a></li>
            <li><a href="#fitur-kami">Fitur Kami</a></li>
            <li><a href="#kontak">Kontak</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>&copy; 2025 All rights reserved peduli pohon</p>
      </div>
    </footer>

    <script>
      function toggleMenu() {
        const navLinks = document.getElementById("navLinks");
        navLinks.classList.toggle("active");
      }
    </script>
  </body>
</html>
