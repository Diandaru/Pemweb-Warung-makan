<?php
declare(strict_types=1);

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/functions.php';

$menuUnggulan = getMenuUnggulan($daftarMenu);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Usaha - Warung Makan Berkah</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- HEADER -->
    <header class="site-header">
        <div class="container nav-container">
            <a href="index.php" class="brand-title">🍲 Warung Makan Berkah</a>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php" class="active">Profil Usaha</a></li>
                    <li><a href="katalog.php">Katalog &amp; Pesan</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- HERO PROFIL -->
    <section class="hero-profile">
        <div class="container">
            <h1>Selamat Datang di Warung Makan Berkah</h1>
            <p>Menyajikan aneka hidangan nusantara rumahan yang lezat, higienis, dan terbuat dari bahan-bahan pilihan berkualitas sejak tahun 2020.</p>
            <a href="katalog.php" class="btn btn-primary">Lihat Katalog Menu &amp; Pesan Sekarang</a>
        </div>
    </section>

    <!-- TENTANG KAMI -->
    <main class="container">
        <section class="section" style="text-align: center; max-width: 800px; margin: 0 auto;">
            <h2 class="section-title">Cerita &amp; Komitmen Kami</h2>
            <p style="color: #57534e; line-height: 1.7; margin-top: 1rem;">
                Warung Makan Berkah berawal dari sebuah dapur keluarga kecil dengan kecintaan mendalam terhadap kuliner cita rasa khas Nusantara. Kami berkomitmen untuk selalu menyajikan makanan segar setiap hari tanpa bahan pengawet demi menjaga kepuasan dan kesehatan para pelanggan setia kami di Solo dan sekitarnya.
            </p>
        </section>

        <!-- BEBERAPA MENU UNGGULAN UNTUK PENGENALAN -->
        <section class="section">
            <h2 class="section-title">Menu Favorit &amp; Unggulan Kami</h2>
            <p class="section-desc">Beberapa hidangan pilihan yang paling sering dicari dan disukai oleh pelanggan.</p>
            
            <div class="menu-grid">
                <?php foreach ($menuUnggulan as $item): ?>
                    <article class="menu-card">
                        <img src="<?= e($item['foto']) ?>" alt="<?= e($item['nama']) ?>" class="menu-img" loading="lazy">
                        <div class="menu-body">
                            <span class="menu-cat"><?= e($item['kategori']) ?></span>
                            <h3 class="menu-name"><?= e($item['nama']) ?></h3>
                            <p class="menu-text"><?= e($item['deskripsi']) ?></p>
                            <div class="menu-price"><?= e(formatRupiah($item['harga'])) ?></div>
                            <a href="katalog.php" class="btn btn-primary" style="text-align: center;">Pesan di Katalog</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container">
            <p>&copy; <?= e(date('Y')) ?> Warung Makan Berkah. All rights reserved.</p>
            <p style="font-size: 0.85rem; margin-top: 0.3rem; color: #a8a29e;">Jl. Melati No. 45, Surakarta | Buka Setiap Hari: 09.00 - 21.00 WIB</p>
        </div>
    </footer>

</body>
</html>