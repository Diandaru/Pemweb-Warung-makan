<?php

declare(strict_types=1);

/**
 * ==============================================================================
 * FUNGSI BANTU & LOGIKA PEMROGRAMAN SISI SERVER
 * ==============================================================================
 * File ini berisi kumpulan fungsi buatan sendiri untuk aplikasi SpaceHub.
 * Dibuat sederhana dan ramah bagi pemula sesuai ketentuan teknis UTS:
 * 1. Setiap file PHP diawali declare(strict_types=1);
 * 2. Fungsi buatan sendiri memiliki tipe parameter dan return type yang jelas.
 * 3. Memanfaatkan fungsi array bawaan PHP (count, array_column, array_sum, array_filter, usort).
 * 4. Fungsi e() untuk perlindungan keamanan XSS dengan htmlspecialchars.
 * 5. Percabangan match expression untuk menentukan badge status dan warna.
 * ==============================================================================
 */

/**
 * Mengamankan cetakan teks HTML dari risiko serangan Cross-Site Scripting (XSS)
 *
 * @param string|int|float|null $nilai Data yang akan dicetak ke HTML
 * @return string Teks yang sudah disanitasi
 */
function e(string|int|float|null $nilai): string
{
    return htmlspecialchars((string) ($nilai ?? ''), ENT_QUOTES, 'UTF-8');
}

/**
 * Memformat angka bulat menjadi format mata uang Rupiah Indonesia
 * Contoh: 50000 -> "Rp 50.000"
 *
 * @param int $nominal Angka nominal harga
 * @return string Teks berformat mata uang Rupiah
 */
function formatRupiah(int $nominal): string
{
    return 'Rp ' . number_format($nominal, 0, ',', '.');
}

/**
 * Menentukan label teks dan warna badge berdasarkan status ketersediaan ruangan
 * Menggunakan fitur percabangan match expression
 *
 * @param string $status Teks status ruangan ("Tersedia", "Penuh", dll)
 * @return array{label: string, class: string} Array asosiatif berisi teks label dan nama kelas CSS
 */
function getBadgeStatus(string $status): array
{
    return match ($status) {
        'Tersedia'       => ['label' => 'Tersedia',            'class' => 'badge-success'],
        'Penuh'          => ['label' => 'Penuh / Dipesan',      'class' => 'badge-danger'],
        'Khusus Member'  => ['label' => 'Khusus Member',       'class' => 'badge-warning'],
        default          => ['label' => 'Hubungi Admin',       'class' => 'badge-secondary'],
    };
}

/**
 * Menghitung total kapasitas tampung (orang) dari seluruh data ruangan
 * Menggunakan fungsi bawaan array: array_column() dan array_sum()
 *
 * @param array $ruanganList Kumpulan data ruangan
 * @return int Total kapasitas orang
 */
function hitungTotalKapasitas(array $ruanganList): int
{
    // Mengambil kolom 'kapasitas' dari setiap item
    $daftarKapasitas = array_column($ruanganList, 'kapasitas');

    // Menjumlahkan seluruh angka kapasitas
    return (int) array_sum($daftarKapasitas);
}

/**
 * Menghitung rata-rata harga sewa dari seluruh ruangan yang terdaftar
 * Menggunakan fungsi bawaan array: count(), array_column(), dan array_sum()
 *
 * @param array $ruanganList Kumpulan data ruangan
 * @return int Rata-rata nominal harga (dibulatkan)
 */
function hitungRataRataHarga(array $ruanganList): int
{
    $totalItem = count($ruanganList);
    if ($totalItem === 0) {
        return 0;
    }

    $daftarHarga = array_column($ruanganList, 'harga');
    $totalHarga  = (int) array_sum($daftarHarga);

    return (int) round($totalHarga / $totalItem);
}

/**
 * Menghitung berapa banyak unit ruangan yang saat ini berstatus 'Tersedia'
 * Menggunakan fungsi bawaan array: array_filter() dan count()
 *
 * @param array $ruanganList Kumpulan data ruangan
 * @return int Jumlah ruangan yang tersedia
 */
function hitungRuanganTersedia(array $ruanganList): int
{
    $ruanganTersedia = array_filter(
        $ruanganList,
        fn(array $item): bool => $item['status'] === 'Tersedia'
    );

    return count($ruanganTersedia);
}
