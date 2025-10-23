<?php
require '../koneksi.php';
header('Content-Type: application/json; charset=utf-8');

$res = [];
$q = mysqli_query($conn, "SELECT id, nama, kategori, stok, harga, updated_at FROM produk ORDER BY id DESC");
if ($q) {
  while ($r = mysqli_fetch_assoc($q)) {
    if (!empty($r['updated_at'])) {
      $date = new DateTime($r['updated_at']);
      $r['updated_at'] = $date->format('d M Y');
    }
    $res[] = $r;
  }
  echo json_encode($res);
} else {
  http_response_code(500);
  echo json_encode(["error" => mysqli_error($conn)]);
}
?>
