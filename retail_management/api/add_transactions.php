<?php
header('Content-Type: application/json; charset=utf-8');
require_once '../koneksi.php';

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

if (!$data || !isset($data['items']) || !is_array($data['items'])) {
  http_response_code(400);
  echo json_encode(["status" => "error", "message" => "Invalid transaction data"]);
  exit;
}

$total = (int)($data['total'] ?? 0);
$items = $data['items'];
$tanggal = date("Y-m-d");
$totalProdukTerjual = 0;

foreach ($items as $it) {
  $totalProdukTerjual += (int)($it['qty'] ?? 0);
}

$conn->begin_transaction();

try {
  $stmt = $conn->prepare("INSERT INTO transaksihariini (pendapatan, total_produk_terjual, tanggal) VALUES (?, ?, ?)");
  if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);
  $stmt->bind_param("iis", $total, $totalProdukTerjual, $tanggal);
  if (!$stmt->execute()) throw new Exception("Execute failed: " . $stmt->error);
  $stmt->close();

  $stmtUpdate = $conn->prepare("UPDATE produk SET stok = stok - ? WHERE id = ?");
  if (!$stmtUpdate) throw new Exception("Prepare update failed: " . $conn->error);

  foreach ($items as $it) {
    $id = (int)$it['id'];
    $qty = (int)$it['qty'];
    $stmtUpdate->bind_param("ii", $qty, $id);
    if (!$stmtUpdate->execute()) {
      throw new Exception("Gagal update stok untuk produk ID $id: " . $stmtUpdate->error);
    }
  }
  $stmtUpdate->close();

  $conn->commit();
  echo json_encode(["status" => "success", "message" => "Transaksi berhasil disimpan."]);
  exit;
} catch (Exception $e) {
  $conn->rollback();
  http_response_code(500);
  echo json_encode(["status" => "error", "message" => $e->getMessage()]);
  exit;
}
