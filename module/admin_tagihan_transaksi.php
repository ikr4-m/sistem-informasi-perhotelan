<?php
require '../connection.php';
$no_transaksi = @$_POST['no_transaksi'];
$id_tamu = @$_POST['id_tamu'];
$total_tagihan = @$_POST['total_tagihan'];
$issued_date = date('Y-m-d');
$id_kamar = $_DB->query("SELECT * FROM tbl_tamu WHERE id_tamu='$id_tamu'")
    ->fetch_all(MYSQLI_ASSOC)[0]['id_kamar'];

$query = $_DB->query("DELETE FROM tbl_user WHERE id_tamu='$id_tamu'");
$query = $_DB->query(<<<"QUERY"
                        UPDATE tbl_tamu SET
                        status='0'
                        WHERE id_tamu='$id_tamu'
                        QUERY);
$query = $_DB->query(<<<"QUERY"
                        UPDATE tbl_kamar SET
                        status_kamar='0'
                        WHERE id_kamar='$id_kamar'
                        QUERY);
$query = $_DB->query(<<<"QUERY"
                        INSERT INTO tbl_tagihan VALUES
                        ('$no_transaksi', '$id_tamu', '$total_tagihan', '$issued_date')
                        QUERY);
if ($query) {
    die(
        alertReturn(
            'Transaksi berhasil! Tamu check out hari ini.',
            '../dashboard.php?page=tagihan'
        )
    );
}
