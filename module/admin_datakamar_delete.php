<?php
require '../connection.php';
$id_kamar = @$_POST['id_kamar'];

// Apabila kamarnya dihuni, jangan di hapus
$query = $_DB->query("SELECT * FROM tbl_kamar WHERE id_kamar='$id_kamar' AND status_kamar='1'");
if ($query->num_rows > 0) {
    die(
        alertReturn(
            'Ada tamu yang menggunakan kamar ini.',
            '../dashboard.php?page=data_kamar'
        )
    );
}

$query = $_DB->query("DELETE FROM tbl_kamar WHERE id_kamar='$id_kamar'");
if ($query) {
    echo alertReturn(
        'Data berhasil di hapus!',
        '../dashboard.php?page=data_kamar'
    );
}
