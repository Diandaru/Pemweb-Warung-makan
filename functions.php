<?php
declare(strict_types=1);

/**
 * Mengamankan teks dari XSS
 */
function e(string|int|float|null $nilai): string
{
    return htmlspecialchars((string) ($nilai ?? ''), ENT_QUOTES, 'UTF-8');
}

/**
 * Format angka ke format Rupiah
 */
function formatRupiah(int $nominal): string
{
    return 'Rp ' . number_format($nominal, 0, ',', '.');
}

/**
 * Menyaring menu yang berstatus unggulan untuk dihalaman profil
 */
function getMenuUnggulan(array $daftarMenu): array
{
    return array_filter($daftarMenu, fn($item) =>$item['unggulan'] === true);
}