<?php
require '../koneksi.php';
header('Content-Type: application/json; charset=utf-8');

$res = [];

$q1 = mysqli_query($conn, "SELECT SUM(total_pendapatanperhari) AS total_week FROM transaksiharian");
$r1 = mysqli_fetch_assoc($q1);
$res['totalSalesWeek'] = (int)($r1['total_week'] ?? 0);

$q2 = mysqli_query($conn, "SELECT AVG(total_pendapatanperhari) AS avg_week FROM transaksiharian");
$r2 = mysqli_fetch_assoc($q2);
$res['averageSalesWeek'] = (int)($r2['avg_week'] ?? 0);

$q3 = mysqli_query($conn, "SELECT SUM(total_transaksiperhari) AS total_transaksi_week FROM transaksiharian");
$r3 = mysqli_fetch_assoc($q3);
$res['totalTransactionDaily'] = (int)($r3['total_transaksi_week'] ?? 0);

$q4 = mysqli_query($conn, "SELECT SUM(total_produk_terjual) AS total_sold_week FROM transaksiharian");
$r4 = mysqli_fetch_assoc($q4);
$res['totalProductSoldWeekly'] = (int)($r4['total_sold_week'] ?? 0);

$q5 = mysqli_query($conn, "SELECT SUM(total_pendapatanperminggu) AS total_month FROM transaksimingguan");
$r5 = mysqli_fetch_assoc($q5);
$res['totalSalesMonth'] = (int)($r5['total_month'] ?? 0);

$q6 = mysqli_query($conn, "SELECT AVG(total_pendapatanperminggu) AS avg_month FROM transaksimingguan");
$r6 = mysqli_fetch_assoc($q6);
$res['averageSalesMonth'] = (int)($r6['avg_month'] ?? 0);

$q7 = mysqli_query($conn, "SELECT SUM(total_transaksiperminggu) AS total_transaksi_month FROM transaksimingguan");
$r7 = mysqli_fetch_assoc($q7);
$res['totalTransactionWeek'] = (int)($r7['total_transaksi_month'] ?? 0);

$q8 = mysqli_query($conn, "SELECT SUM(total_produk_terjual) AS total_sold_month FROM transaksimingguan");
$r8 = mysqli_fetch_assoc($q8);
$res['totalProductSoldMonthly'] = (int)($r8['total_sold_month'] ?? 0);

echo json_encode($res);
