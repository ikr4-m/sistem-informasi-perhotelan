<?php
require '../connection.php';
$id_tamu = @$_POST['id_tamu'];
$tgl_check_out = date('Y-m-d');

// Hapus transaksinya sama ganti tanggal checkoutnya
$id_kamar = $_DB->query("SELECT * FROM tbl_tamu WHERE id_tamu='$id_tamu'")
    ->fetch_all(MYSQLI_ASSOC)[0]['id_kamar'];
$query = $_DB->query(<<<"QUERY"
                        UPDATE tbl_kamar SET
                        status_kamar='0', tgl_check_out='$tgl_check_out'
                        WHERE id_kamar='$id_kamar'
                        QUERY);
$query = $_DB->query("DELETE FROM tbl_transaksi_jasa WHERE id_tamu='$id_tamu'");
$query = $_DB->query("DELETE FROM tbl_tagihan WHERE id_tamu='$id_tamu'");
$query = $_DB->query("DELETE FROM tbl_user WHERE id_tamu='$id_tamu'");

$query = $_DB->query("DELETE FROM tbl_tamu WHERE id_tamu='$id_tamu'");
if ($query) {
    echo alertReturn(
        'Data berhasil di hapus!',
        '../dashboard.php?page=data_tamu'
    );
}
