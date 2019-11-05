<?php
require '../connection.php';
header('Content-Type: application/json');
$id_tamu = @$_GET['id_tamu'];

$query = $_DB->query("SELECT * FROM view_transaksi_jasa WHERE id_tamu='$id_tamu'");
$ret = array();
if ($query->num_rows > 0) {
    $ret = $query->fetch_all(MYSQLI_ASSOC);
}

echo json_encode($ret);
