<?php
require '../connection.php';
header('Content-Type: application/json');

$id_tamu = @$_GET['id_tamu'];

// Dapatkan data dari tabel Tamu dan Kamar
$view_tamu = $_DB->query("SELECT * FROM view_tamu WHERE id_tamu='$id_tamu'")
  ->fetch_all(MYSQLI_ASSOC)[0];
// Dapatkan data dari riwayat transaksi jasa
$view_jasa = $_DB->query("SELECT * FROM view_transaksi_jasa WHERE id_tamu='$id_tamu'")
  ->fetch_all(MYSQLI_ASSOC);

die(json_encode([
    'tamu' => $view_tamu,
    'jasa' => $view_jasa 
]));
