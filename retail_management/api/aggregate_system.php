<?php

require '../koneksi.php';
date_default_timezone_set("Asia/Jakarta");

echo "=== Sistem Agregat VisTrackr ===\n";

$lastDay = date("Y-m-d");
$lastWeek = date("W");
$lastMonth = date("m");

function logMessage($msg) {
    $time = date("Y-m-d H:i:s");
    file_put_contents(__DIR__ . "/aggregate_log.txt", "[$time] $msg\n", FILE_APPEND);
    echo "[$time] $msg\n";
}

while (true) {
    try {
        $tanggal = date("Y-m-d");
        $mingguKe = date("W");
        $tahun = date("Y");
        $bulan = date("m");

        echo "[" . date("H:i:s") . "] Mengecek status...\n";

        $res = $conn->query("SELECT 
        IFNULL(SUM(pendapatan),0) AS totalPendapatan,
        IFNULL(SUM(total_produk_terjual),0) AS totalProduk,
        COUNT(*) AS totalTransaksi
        FROM transaksihariini
        ");

        $row = $res->fetch_assoc();
        $totalPendapatan = (int)$row['totalPendapatan'];
        $totalProdukTerjual = (int)$row['totalProduk'];
        $totalTransaksi = (int)$row['totalTransaksi'];

        if ($tanggal != $lastDay) {
            logMessage("Hari berganti → buat data harian baru.");

            if ($totalPendapatan > 0 || $totalProdukTerjual > 0) {
                $conn->query("
                    INSERT INTO transaksiharian (total_pendapatanperhari, total_transaksiperhari, total_produk_terjual, waktu)
                    VALUES ($totalPendapatan, $totalTransaksi, $totalProdukTerjual, '$lastDay')
                ");
                logMessage("Data harian ($lastDay) disimpan ke transaksiharian.");
            }

            $conn->query("TRUNCATE TABLE transaksihariini");
            logMessage("Reset tabel transaksihariini selesai.");

            $lastDay = $tanggal;
        }

        if ($mingguKe != $lastWeek) {
            echo "Minggu berganti → buat data mingguan baru.\n";

            $resWeek = $conn->query("SELECT 
                IFNULL(SUM(total_pendapatanperhari),0) AS totalPendapatan,
                IFNULL(SUM(total_transaksiperhari),0) AS totalTransaksi,
                IFNULL(SUM(total_produk_terjual),0) AS totalProduk
                FROM transaksiharian
            ");
            $rWeek = $resWeek->fetch_assoc();

            $totPendWeek = (int)$rWeek['totalPendapatan'];
            $totTransWeek = (int)$rWeek['totalTransaksi'];
            $totProdWeek = (int)$rWeek['totalProduk'];

            if ($totPendWeek > 0) {
                $conn->query("
                    INSERT INTO transaksimingguan (total_pendapatanperminggu, total_transaksiperminggu, total_produk_terjual, periode)
                    VALUES ($totPendWeek, $totTransWeek, $totProdWeek, '$tanggal')
                ");
                echo "Data minggu ke-$lastWeek ditambahkan ke transaksimingguan.\n";
            }

            $conn->query("TRUNCATE TABLE transaksiharian");
            echo "Reset tabel transaksiharian selesai.\n";

            $lastWeek = $mingguKe;
        }

        if ($bulan != $lastMonth) {
            echo "Bulan berganti → reset data mingguan.\n";
            $conn->query("TRUNCATE TABLE transaksimingguan");
            echo "Reset tabel transaksimingguan selesai.\n";
            $lastMonth = $bulan;
        }

        echo "Siklus selesai — menunggu 5 menit lagi...\n\n";
        sleep(300); 
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "\n";
        sleep(60);
    }
}
?>
