<?php
require '../connection.php';
$id_tamu = @$_GET['id_tamu'];

$query = $_DB->query("SELECT * FROM tbl_tamu WHERE id_tamu='$id_tamu'");
$data = array();
if ($query->num_rows > 0) {
    $data = $query->fetch_all(MYSQLI_ASSOC)[0];
}

echo json_encode($data);
