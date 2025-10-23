<?php
require '../koneksi.php';
header('Content-Type: application/json; charset=utf-8');
$input = json_decode(file_get_contents('php://input'), true);

$nama = mysqli_real_escape_string($conn, $input['nama'] ?? '');
$kategori = mysqli_real_escape_string($conn, $input['kategori'] ?? '');
$stok = intval($input['stok'] ?? 0);
$harga = intval($input['harga'] ?? 0);

if (empty($nama)) {
  http_response_code(400);
  echo json_encode(["status"=>"error", "message"=>"Nama produk wajib."]);
  exit;
}

$sql = "INSERT INTO produk (nama,kategori,stok,harga) VALUES ('$nama','$kategori',$stok,$harga)";
if (mysqli_query($conn, $sql)) echo json_encode(["status"=>"success", "id"=> mysqli_insert_id($conn)]);
else { http_response_code(500); echo json_encode(["status"=>"error","message"=>mysqli_error($conn)]); }
?>
