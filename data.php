<?php

declare(strict_types=1);

/**
 * ==============================================================================
 * DATA UTAMA RUANG KERJA (ARRAY MULTIDIMENSI)
 * ==============================================================================
 * File ini berisi master data untuk layanan persewaan ruang kerja SpaceHub.
 * Mengikuti ketentuan UTS:
 * - Menggunakan declare(strict_types=1);
 * - Array multidimensi (array yang berisi kumpulan array asosiatif)
 * - Berisi minimal 8 item (di sini tersedia 10 item)
 * - Setiap item memiliki minimal 4 atribut (di sini ada 10 atribut)
 * ==============================================================================
 */

$daftarRuangan = [
    [
        'id'          => 1,
        'nama'        => 'Hot Desk Coworking',
        'kategori'    => 'Coworking Space',
        'kapasitas'   => 1,
        'harga'       => 50000,
        'tipe_sewa'   => 'per hari',
        'fasilitas'   => ['WiFi 100 Mbps', 'Free Coffee & Tea', 'Stopkontak Pribadi', 'Loker Harian'],
        'status'      => 'Tersedia',
        'deskripsi'   => 'Meja kerja fleksibel di area komunal modern. Sangat pas untuk freelancer, mahasiswa, dan remote worker yang membutuhkan suasana kerja fokus.',
        'rating'      => 4.8
    ],
    [
        'id'          => 2,
        'nama'        => 'Dedicated Desk Pro',
        'kategori'    => 'Coworking Space',
        'kapasitas'   => 1,
        'harga'       => 1200000,
        'tipe_sewa'   => 'per bulan',
        'fasilitas'   => ['Meja Tetap Pribadi', 'Kursi Ergonomis', 'Loker Kunci', 'Akses 24/7', 'Kredit Print 50 Lembar'],
        'status'      => 'Tersedia',
        'deskripsi'   => 'Meja kerja pribadi khusus milik Anda selama sebulan penuh tanpa perlu berpindah-pindah. Termasuk fasilitas penyimpanan barang pribadi.',
        'rating'      => 4.9
    ],
    [
        'id'          => 3,
        'nama'        => 'Private Office Studio 4',
        'kategori'    => 'Private Office',
        'kapasitas'   => 4,
        'harga'       => 4500000,
        'tipe_sewa'   => 'per bulan',
        'fasilitas'   => ['Ruangan Kedap Suara', 'Smart Lock Keyless', 'AC Mandiri', 'Akses Meeting Room 5 Jam/bln'],
        'status'      => 'Tersedia',
        'deskripsi'   => 'Ruang kantor privat tertutup yang dirancang untuk startup dan tim beranggotakan 4 orang. Menawarkan privasi penuh dan keamanan optimal.',
        'rating'      => 4.7
    ],
    [
        'id'          => 4,
        'nama'        => 'Executive Suite 8',
        'kategori'    => 'Private Office',
        'kapasitas'   => 8,
        'harga'       => 8500000,
        'tipe_sewa'   => 'per bulan',
        'fasilitas'   => ['Pemandangan Kota', 'Smart TV 55 Inch', 'Papan Tulis Kaca', 'Ruang Tamu Mini', 'Akses 24/7'],
        'status'      => 'Penuh',
        'deskripsi'   => 'Kantor eksekutif premium untuk tim 8 orang dengan jendela panorama perkotaan, sofa tamu, dan fasilitas presentasi eksklusif.',
        'rating'      => 5.0
    ],
    [
        'id'          => 5,
        'nama'        => 'Creative Meeting Room',
        'kategori'    => 'Meeting Room',
        'kapasitas'   => 6,
        'harga'       => 100000,
        'tipe_sewa'   => 'per jam',
        'fasilitas'   => ['Smart TV 4K', 'Glass Board', 'Proyektor Mini', 'Kabel HDMI/Type-C', 'Air Mineral'],
        'status'      => 'Tersedia',
        'deskripsi'   => 'Ruang rapat interaktif untuk diskusi kelompok, presentasi klien, atau sesi brainstorming tim dengan nuansa kreatif.',
        'rating'      => 4.6
    ],
    [
        'id'          => 6,
        'nama'        => 'Boardroom VIP Suite',
        'kategori'    => 'Meeting Room',
        'kapasitas'   => 16,
        'harga'       => 250000,
        'tipe_sewa'   => 'per jam',
        'fasilitas'   => ['Kamera Video Conference 4K', 'Mic Speaker Jabra', 'Proyektor Laser HD', 'Layanan Coffee Break'],
        'status'      => 'Khusus Member',
        'deskripsi'   => 'Ruang konferensi formal berstandar korporasi dengan perlengkapan telekonferensi canggih untuk pertemuan dewan direksi dan rapat penting.',
        'rating'      => 4.9
    ],
    [
        'id'          => 7,
        'nama'        => 'Podcast & Studio Audio',
        'kategori'    => 'Studio Kreatif',
        'kapasitas'   => 4,
        'harga'       => 150000,
        'tipe_sewa'   => 'per jam',
        'fasilitas'   => ['4 Mic Shure MV7', 'Audio Mixer Rodecaster', 'Peredam Akustik Profesional', 'Lampu Studio Ring Light'],
        'status'      => 'Tersedia',
        'deskripsi'   => 'Studio kedap suara siap pakai untuk rekaman podcast, sulih suara (voice over), siaran langsung, atau wawancara digital.',
        'rating'      => 4.8
    ],
    [
        'id'          => 8,
        'nama'        => 'Event & Workshop Hall',
        'kategori'    => 'Event Space',
        'kapasitas'   => 50,
        'harga'       => 750000,
        'tipe_sewa'   => 'per jam',
        'fasilitas'   => ['Sound System 2000W', '2 Wireless Mics', 'Panggung Mini', 'Proyektor Raksasa', 'Kursi Seminar Fleksibel'],
        'status'      => 'Tersedia',
        'deskripsi'   => 'Aula serbaguna dengan tata letak modular yang cocok untuk seminar, workshop teknologi, sesi pelatihan, dan networking event.',
        'rating'      => 4.9
    ],
    [
        'id'          => 9,
        'nama'        => 'Virtual Office Premium',
        'kategori'    => 'Virtual Office',
        'kapasitas'   => 0,
        'harga'       => 350000,
        'tipe_sewa'   => 'per bulan',
        'fasilitas'   => ['Alamat Bisnis Prestisius', 'Penerimaan Surat/Paket', 'Nomor Telepon Khusus', 'Resepsionis Profesional'],
        'status'      => 'Tersedia',
        'deskripsi'   => 'Layanan alamat bisnis prestisius untuk legalitas usaha dan PKP tanpa harus menyewa ruang fisik sehari-hari.',
        'rating'      => 4.7
    ]
];
