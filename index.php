<?php

declare(strict_types=1);

/**
 * ==============================================================================
 * HALAMAN PROFIL (INDEX.PHP) - SPACEHUB COWORKING
 * ==============================================================================
 * Menampilkan profil usaha ringkas, fasilitas utama, dan informasi kontak.
 * Didesain simpel, elegan, dan ramah pemula.
 * Struktur HTML5 semantik: header, nav, main, section, article, footer.
 * Heading teratur berurutan: h1 -> h2 -> h3.
 * ==============================================================================
 */

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';

// Menghitung statistik ringkas untuk ditampilkan di profil
$totalRuang      = count($daftarRuangan);
$ruanganTersedia = hitungRuanganTersedia($daftarRuangan);
$totalKapasitas  = hitungTotalKapasitas($daftarRuangan);
$ruangTermurah   = cariRuanganTermurah($daftarRuangan);
$hargaMulai      = $ruangTermurah !== null ? formatRupiah($ruangTermurah['harga']) : 'Rp 0';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Usaha - SpaceHub Workspace Solutions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- 1. HEADER & NAVIGASI SEMANTIK -->
    <header class="site-header">
        <div class="container nav-container">
            <a href="index.php" class="brand-title">
                🏢 SpaceHub
                <span class="brand-badge">Workspace Solutions</span>
            </a>
            <nav class="main-nav" aria-label="Navigasi Utama">
                <ul>
                    <li><a href="index.php" class="active">Profil Usaha</a></li>
                    <li><a href="katalog.php">Katalog Ruangan</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- 2. MAIN CONTENT -->
    <main>
        <!-- HERO SECTION SIMPEL -->
        <section class="hero-section">
            <div class="container hero-grid">
                <div class="hero-content">
                    <h1>Sewa Ruang Kerja Nyaman &amp; Fleksibel</h1>
                    <p>
                        SpaceHub menyediakan ruang kerja modern untuk pekerja lepas, tim startup, dan perusahaan dengan pilihan sewa harian hingga bulanan.
                    </p>
                    <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
                        <a href="katalog.php" class="btn btn-accent">Buka Katalog Ruangan &raquo;</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- STATISTIK RINGKAS SISI SERVER -->
        <section class="container stats-strip" aria-label="Ringkasan Statistik">
            <div class="stats-grid">
                <article class="stat-card">
                    <div class="stat-label">Total Ruang Kerja</div>
                    <div class="stat-value"><?= e($totalRuang) ?> Unit</div>
                </article>
                <article class="stat-card">
                    <div class="stat-label">Ruang Siap Pakai</div>
                    <div class="stat-value" style="color: var(--color-accent);"><?= e($ruanganTersedia) ?> Ruang</div>
                </article>
                <article class="stat-card">
                    <div class="stat-label">Kapasitas Total</div>
                    <div class="stat-value"><?= e($totalKapasitas) ?> Orang</div>
                </article>
                <article class="stat-card">
                    <div class="stat-label">Harga Sewa Mulai</div>
                    <div class="stat-value"><?= e($hargaMulai) ?></div>
                </article>
            </div>
        </section>

        <!-- PROFIL USAHA & KONTAK SINGKAT -->
        <section class="container content-section" style="padding-top: 0;">
            <div class="about-grid">
                <div>
                    <h2>Tentang SpaceHub</h2>
                    <p style="margin-top: 0.75rem; color: var(--color-slate); line-height: 1.6;">
                        SpaceHub berdiri sejak tahun 2022 sebagai solusi tempat kerja fleksibel tanpa kontrak yang rumit. Kami menyediakan lingkungan kerja yang tenang, bersih, dan dilengkapi fasilitas pendukung produktivitas seperti internet cepat, kopi gratis, dan bilik kedap suara.
                    </p>
                    <p style="margin-top: 0.75rem; color: var(--color-slate); line-height: 1.6;">
                        Cocok untuk Anda yang membutuhkan meja kerja harian, kantor privat bersama tim, maupun ruang pertemuan profesional untuk bertemu klien.
                    </p>
                </div>
                <div id="kontak">
                    <h2>Kontak Layanan</h2>
                    <ul class="info-list">
                        <li class="info-item">
                            <span>🕒</span>
                            <span><strong>Jam Buka:</strong> Senin – Sabtu: 08.00 – 21.00 WIB</span>
                        </li>
                        <li class="info-item">
                            <span>📞</span>
                            <span><strong>WhatsApp:</strong> 0812-3456-7890</span>
                        </li>
                        <li class="info-item">
                            <span>✉️</span>
                            <span><strong>Email:</strong> halo@spacehub-workspace.com</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- 3 POIN FASILITAS UNGGULAN -->
        <section class="container content-section" style="padding-top: 0;">
            <div class="section-header">
                <h2>Fasilitas Utama</h2>
                <p>Tiga keuntungan utama yang Anda dapatkan saat menggunakan layanan kami.</p>
            </div>
            <div class="features-grid">
                <article class="feature-card">
                    <h3>⚡ Internet Fiber 100 Mbps</h3>
                    <p>Koneksi internet cepat dan stabil dengan backup provider agar rapat online selalu lancar.</p>
                </article>
                <article class="feature-card">
                    <h3>☕ Free Coffee &amp; Tea</h3>
                    <p>Minuman teh, kopi espresso, dan air mineral gratis tanpa batas sepanjang hari kerja Anda.</p>
                </article>
                <article class="feature-card">
                    <h3>🔒 Akses Aman 24/7</h3>
                    <p>Sistem kunci kartu digital serta pemantauan kamera CCTV di seluruh ruangan untuk kenyamanan Anda.</p>
                </article>
            </div>
        </section>
    </main>

    <!-- 3. FOOTER SEMANTIK (HANYA COPYRIGHT) -->
    <footer class="site-footer">
        <div class="container footer-content">
            <p>&copy; <?= e(date('Y')) ?> SpaceHub - Proyek Mini Pemrograman Web. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
