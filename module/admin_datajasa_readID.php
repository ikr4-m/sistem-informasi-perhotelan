<?php
require '../connection.php';
$id_jasa = @$_GET['id_jasa'];

$query = $_DB->query("SELECT * FROM tbl_jasa WHERE id_jasa='$id_jasa'");
$data = array();
if ($query->num_rows > 0) {
    $data = $query->fetch_all(MYSQLI_ASSOC)[0];
}

echo json_encode($data);
