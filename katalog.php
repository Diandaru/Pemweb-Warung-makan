<?php

declare(strict_types=1);

/**
 * ==============================================================================
 * HALAMAN KATALOG DINAMIS (KATALOG.PHP) - SPACEHUB COWORKING
 * ==============================================================================
 * Menampilkan daftar katalog ruang kerja secara dinamis dan bersih.
 * Fitur:
 * 1. Render data utama menggunakan perulangan foreach dari data.php
 * 2. Ringkasan hasil hitung matematis (count, array_sum, array_column, array_filter)
 * 3. Percabangan match untuk styling badge status ketersediaan
 * 4. Sanitasi seluruh output ke HTML dengan fungsi e() (htmlspecialchars)
 * ==============================================================================
 */

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';

// Menghitung ringkasan data statistik sisi server
$totalRuang      = count($daftarRuangan);
$ruanganTersedia = hitungRuanganTersedia($daftarRuangan);
$totalKapasitas  = hitungTotalKapasitas($daftarRuangan);
$rataRataHarga   = hitungRataRataHarga($daftarRuangan);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Ruang Kerja & Serviced Office - SpaceHub</title>
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
                    <li><a href="index.php">Profil Usaha</a></li>
                    <li><a href="katalog.php" class="active">Katalog Ruangan</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- 2. MAIN CONTENT -->
    <main class="container content-section">
        <!-- HEADER HALAMAN -->
        <header class="section-header" style="text-align: left; margin-bottom: 1.5rem;">
            <h1>Katalog Pilihan Ruang Kerja</h1>
        </header>

        <!-- RINGKASAN HASIL HITUNG (SUMMARY STATS CARDS) -->
        <section class="stats-strip" style="margin-top: 0; margin-bottom: 2rem;" aria-label="Ringkasan Data Ruangan">
            <h2 style="font-size: 1.1rem; margin-bottom: 0.75rem; color: var(--color-slate);">Ringkasan Ruang Kerja</h2>
            <div class="stats-grid">
                <article class="stat-card">
                    <div class="stat-label">Total Unit Ruangan</div>
                    <div class="stat-value"><?= e($totalRuang) ?> Unit</div>
                </article>
                <article class="stat-card">
                    <div class="stat-label">Ruangan Siap Pakai</div>
                    <div class="stat-value" style="color: var(--color-accent);"><?= e($ruanganTersedia) ?> Ruang</div>
                </article>
                <article class="stat-card">
                    <div class="stat-label">Total Daya Tampung</div>
                    <div class="stat-value"><?= e($totalKapasitas) ?> Orang</div>
                </article>
                <article class="stat-card">
                    <div class="stat-label">Rata-Rata Harga Sewa</div>
                    <div class="stat-value"><?= e(formatRupiah($rataRataHarga)) ?></div>
                </article>
            </div>
        </section>

        <!-- DAFTAR KATALOG UTAMA (DIRENDER DENGAN FOREACH) -->
        <section aria-label="Daftar Ruangan Kerja">
            <h2 style="font-size: 1.25rem; margin-bottom: 1rem; color: var(--color-dark);">Daftar Pilihan Ruang Kerja (<?= e($totalRuang) ?> Pilihan)</h2>
            <div class="catalog-grid">
                <!-- Perulangan foreach untuk merender kartu HTML dinamis tanpa duplikasi manual -->
                <?php foreach ($daftarRuangan as $ruang): ?>
                    <?php
                        // Menentukan badge status berdasarkan fungsi percabangan match
                        $badge = getBadgeStatus($ruang['status']);
                    ?>
                    <article class="room-card">
                        <!-- Konten Kartu (Tanpa Foto) -->
                        <div class="room-body">
                            <div class="card-header-row">
                                <span class="room-category"><?= e($ruang['kategori']) ?></span>
                                <span class="badge <?= e($badge['class']) ?>">
                                    <?= e($badge['label']) ?>
                                </span>
                            </div>
                            <h3 class="room-title"><?= e($ruang['nama']) ?></h3>

                            <!-- Metadata Kapasitas & Rating -->
                            <div class="room-meta">
                                <span>👥 <?= $ruang['kapasitas'] > 0 ? e($ruang['kapasitas']) . ' Orang' : 'Virtual / Domisili' ?></span>
                                <span>⭐ <?= e(number_format($ruang['rating'], 1)) ?></span>
                            </div>

                            <!-- Deskripsi Singkat -->
                            <p class="room-desc"><?= e($ruang['deskripsi']) ?></p>

                            <!-- Daftar Fasilitas -->
                            <div class="room-facilities">
                                <?php foreach ($ruang['fasilitas'] as $fasilitas): ?>
                                    <span class="facility-pill">✓ <?= e($fasilitas) ?></span>
                                <?php endforeach; ?>
                            </div>

                            <!-- Harga & Tombol Sewa -->
                            <div class="room-footer">
                                <div class="price-tag">
                                    <span class="price-label">Mulai Dari</span>
                                    <span class="price-amount">
                                        <?= e(formatRupiah($ruang['harga'])) ?>
                                        <span class="price-unit">/ <?= e($ruang['tipe_sewa']) ?></span>
                                    </span>
                                </div>
                                <div>
                                    <?php if ($ruang['status'] === 'Tersedia'): ?>
                                        <a href="https://wa.me/6281234567890?text=Halo%20SpaceHub,%20saya%20tertarik%20sewa%20<?= urlencode($ruang['nama']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary">
                                            Pesan Sekarang
                                        </a>
                                    <?php else: ?>
                                        <a href="https://wa.me/6281234567890?text=Halo%20SpaceHub,%20kapan%20tersedia%20untuk%20<?= urlencode($ruang['nama']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline">
                                            Tanya Jadwal
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
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
