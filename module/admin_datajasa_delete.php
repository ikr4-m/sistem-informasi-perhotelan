<?php
require '../connection.php';
$id_jasa = @$_POST['id_jasa'];

$query = $_DB->query("DELETE FROM tbl_jasa WHERE id_jasa='$id_jasa'");
if ($query) {
    echo alertReturn(
        'Data berhasil dihapus!',
        '../dashboard.php?page=data_jasa'
    );
}
