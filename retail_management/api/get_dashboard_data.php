<?php
require '../koneksi.php';
header('Content-Type: application/json; charset=utf-8');

$res = [];

$q1 = mysqli_query($conn, "SELECT SUM(pendapatan) AS total_sales FROM transaksihariini");
$r1 = mysqli_fetch_assoc($q1);
$res['totalSalesNow'] = (int)($r1['total_sales'] ?? 0);

$q2 = mysqli_query($conn, "SELECT COUNT(*) AS total_products FROM produk");
$r2 = mysqli_fetch_assoc($q2);
$res['productInStock'] = (int)($r2['total_products'] ?? 0);

$q3 = mysqli_query($conn, "SELECT SUM(stok) AS total_products_stock FROM produk");
$r3 = mysqli_fetch_assoc($q3);
$res['totalStockNow'] = (int)($r3['total_products_stock'] ?? 0);

$q4 = mysqli_query($conn, "SELECT COUNT(*) AS total_transaksi FROM transaksihariini");
$r4 = mysqli_fetch_assoc($q4);
$res['totalTransaksiNow'] = (int)($r4['total_transaksi'] ?? 0);

$q5 = mysqli_query($conn, "SELECT AVG(pendapatan) AS avg_sales FROM transaksihariini");
$r5 = mysqli_fetch_assoc($q5);
$res['averageSalesNow'] = (int)($r5['avg_sales'] ?? 0);

$q6 = mysqli_query($conn, "SELECT SUM(total_produk_terjual) AS total_product_sold FROM transaksihariini");
$r6 = mysqli_fetch_assoc($q6);
$res['totalSoldNow'] = (int)($r6['total_product_sold'] ?? 0);

echo json_encode($res);
