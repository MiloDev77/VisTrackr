<?php
require '../koneksi.php';
header('Content-Type: application/json; charset=utf-8');

$result = ['hariini'=>[], 'harian'=>[], 'mingguan'=>[]];

$q1 = mysqli_query($conn, "
    SELECT id, pendapatan, total_produk_terjual, tanggal, created_at 
    FROM transaksihariini 
    ORDER BY tanggal ASC, id ASC
");
if ($q1) {
    while ($r = mysqli_fetch_assoc($q1)) {
        $result['hariini'][] = $r;
    }
}

$q2 = mysqli_query($conn, "
    SELECT id, total_pendapatanperhari, total_transaksiperhari, 
           total_produk_terjual, waktu, created_at 
    FROM transaksiharian 
    ORDER BY created_at ASC
");
if ($q2) {
    while ($r = mysqli_fetch_assoc($q2)) {
        $result['harian'][] = $r;
    }
}

$q3 = mysqli_query($conn, "
    SELECT id, total_pendapatanperminggu, total_transaksiperminggu, 
           total_produk_terjual, periode, created_at 
    FROM transaksimingguan 
    ORDER BY created_at ASC
");
if ($q3) {
    while ($r = mysqli_fetch_assoc($q3)) {
        $result['mingguan'][] = $r;
    }
}

if (!$q1 || !$q2 || !$q3) {
    http_response_code(500);
    echo json_encode(["error" => mysqli_error($conn)]);
    exit;
}

echo json_encode($result);
?>