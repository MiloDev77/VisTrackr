<?php
require '../koneksi.php';
header('Content-Type: application/json; charset=utf-8');

$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !isset($data['id'])) {
  http_response_code(400);
  echo json_encode(["error" => "ID produk wajib ada"]);
  exit;
}

$id = intval($data['id']);
$nama = $data['nama'] ?? '';
$kategori = $data['kategori'] ?? '';
$stok = intval($data['stok'] ?? 0);
$harga = intval($data['harga'] ?? 0);

$q = mysqli_query($conn, "UPDATE produk SET 
  nama='$nama',
  kategori='$kategori',
  stok=$stok,
  harga=$harga,
  updated_at=NOW()
  WHERE id=$id
");

if ($q) {
  echo json_encode(["success" => true]);
} else {
  http_response_code(500);
  echo json_encode(["error" => mysqli_error($conn)]);
}
?>
