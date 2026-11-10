<?php
declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';

// Inisialisasi variabel perhitungan
$pesananAktif = [];
$grandTotal = 0;
$adaPesanan = false;

// Jika form disubmit (metode POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['qty'])) {
    foreach ($_POST['qty'] as $idMenu => $jumlahPorsi) {
        $qty = (int) $jumlahPorsi;
        if ($qty > 0) {
            // Cari data menu berdasarkan ID
            foreach ($daftarMenu as $menu) {
                if ($menu['id'] == $idMenu) {
                    $subtotal = $menu['harga'] * $qty;
                    $pesananAktif[] = [
                        'nama'   => $menu['nama'],
                        'harga'  => $menu['harga'],
                        'qty'    => $qty,
                        'subtotal' => $subtotal
                    ];
                    $grandTotal += $subtotal;
                    $adaPesanan = true;
                    break;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog &amp; Keranjang Pesanan - Warung Makan Berkah</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- HEADER -->
    <header class="site-header">
        <div class="container nav-container">
            <a href="index.php" class="brand-title">🍲 Warung Makan Berkah</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Profil Usaha</a></li>
                    <li><a href="katalog.php" class="active">Katalog &amp; Pesan</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- KONTEN KATALOG -->
    <main class="container section">
        <header style="text-align: center; margin-bottom: 2rem;">
            <h1 class="section-title">Katalog Menu &amp; Pemesanan</h1>
            <p class="section-desc">Masukkan jumlah porsi pada menu yang Anda inginkan, lalu klik tombol "Hitung Total Pesanan" di bagian bawah.</p>
        </header>

        <!-- FORM UTAMA PEMESANAN -->
        <form action="katalog.php" method="POST">
            <div class="menu-grid">
                <?php foreach ($daftarMenu as $item): ?>
                    <?php 
                        // Ambil nilai input sebelumnya jika form sudah disubmit
                        $inputVal = $_POST['qty'][$item['id']] ?? 0; 
                    ?>
                    <article class="menu-card">
                        <img src="<?= e($item['foto']) ?>" alt="<?= e($item['nama']) ?>" class="menu-img" loading="lazy">
                        
                        <div class="menu-body">
                            <span class="menu-cat"><?= e($item['kategori']) ?></span>
                            <h3 class="menu-name"><?= e($item['nama']) ?></h3>
                            <p class="menu-text"><?= e($item['deskripsi']) ?></p>
                            <div class="menu-price"><?= e(formatRupiah($item['harga'])) ?></div>

                            <!-- Input Jumlah Porsi -->
                            <div style="margin-top: auto; border-top: 1px solid #f5efe6; padding-top: 0.75rem;">
                                <div style="display: flex; gap: 0.5rem; align-items: center;">
                                    <label for="qty_<?= $item['id'] ?>" style="font-size: 0.85rem; font-weight: 600;">Jumlah Porsi:</label>
                                    <input type="number" id="qty_<?= $item['id'] ?>" name="qty[<?= $item['id'] ?>]" class="form-control" value="<?= (int)$inputVal ?>" min="0" max="99" style="width: 80px; text-align: center;">
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>

            <!-- TOMBOL AKSI HITUNG -->
            <div style="text-align: center; margin: 2rem 0;">
                <button type="submit" class="btn btn-primary" style="padding: 0.8rem 2rem; font-size: 1.05rem;">
                    🧮 Hitung Total Pesanan
                </button>
            </div>
        </form>

        <!-- PANEL HASIL PERHITUNGAN & PEMBAYARAN (MUNCUL SETELAH DISUBMIT) -->
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <section style="background: #ffffff; border: 2px solid #d97706; border-radius: 10px; padding: 2rem; max-width: 600px; margin: 2rem auto; box-shadow: 0 4px 15px rgba(0,0,0,0.08);">
                <h2 style="font-size: 1.35rem; color: #78350f; margin-bottom: 1rem; border-bottom: 2px solid #fef3c7; padding-bottom: 0.5rem; text-align: center;">📋 Rincian Tagihan Pesanan Anda</h2>
                
                <?php if ($adaPesanan): ?>
                    <div style="margin-bottom: 1.5rem;">
                        <?php foreach ($pesananAktif as $p): ?>
                            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border-bottom: 1px dashed #f5efe6; font-size: 0.95rem;">
                                <div>
                                    <strong><?= e($p['nama']) ?></strong><br>
                                    <span style="color: #78716c; font-size: 0.85rem;"><?= $p['qty'] ?> porsi × <?= formatRupiah($p['harga']) ?></span>
                                </div>
                                <div style="font-weight: 600; color: #b45309;">
                                    <?= formatRupiah($p['subtotal']) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div style="border-top: 2px solid #e7e5e4; padding-top: 1rem; margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: center; font-size: 1.2rem; font-weight: 700; color: #1c1917;">
                        <span>Total Pembayaran:</span>
                        <span style="color: #16a34a;"><?= formatRupiah($grandTotal) ?></span>
                    </div>
                <?php else: ?>
                    <p style="text-align: center; color: #b91c1c; font-weight: 600; padding: 1rem 0;">Anda belum memilih menu apa pun. Silakan masukkan jumlah porsi di atas lalu klik hitung.</p>
                <?php endif; ?>
            </section>
        <?php endif; ?>

    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?= e(date('Y')) ?> Warung Makan Berkah. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>