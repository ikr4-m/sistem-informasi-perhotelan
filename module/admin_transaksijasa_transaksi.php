<?php
require '../connection.php';
$id_tamu = @$_POST['id_tamu'];
$id_jasa = @$_POST['id_jasa'];
$no_transaksi = @$_POST['no_transaksi'];
$issued_date = date('Y-m-d');

$query = $_DB->query(<<<"QUERY"
                        INSERT INTO tbl_transaksi_jasa
                        VALUES
                        ('$no_transaksi','$id_tamu','$id_jasa','$issued_date')
                        QUERY);

if ($query) {
    echo alertReturn(
        'Transaksi jasa berhasil!',
        '../dashboard.php?page=transaksi_jasa'
    );
}
