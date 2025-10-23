<?php
require '../koneksi.php';
header('Content-Type: application/json; charset=utf-8');
$input = json_decode(file_get_contents('php://input'), true);
$id = intval($input['id'] ?? 0);
if ($id <= 0) { http_response_code(400); echo json_encode(["status"=>"error","message"=>"ID tidak valid"]); exit; }

$sql = "DELETE FROM produk WHERE id=$id";
if (mysqli_query($conn, $sql)) echo json_encode(["status"=>"success"]);
else { http_response_code(500); echo json_encode(["status"=>"error","message"=>mysqli_error($conn)]); }
?>
