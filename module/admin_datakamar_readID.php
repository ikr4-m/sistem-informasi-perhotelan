<?php
require '../connection.php';
$id_kamar = @$_GET['id_kamar'];

$query = $_DB->query("SELECT * FROM tbl_kamar WHERE id_kamar='$id_kamar'");
$data = array();
if ($query->num_rows > 0) {
    $data = $query->fetch_all(MYSQLI_ASSOC)[0];
}

echo json_encode($data);
