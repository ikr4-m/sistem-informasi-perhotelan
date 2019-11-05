<?php
require '../connection.php';
$kode_kamar = @$_POST['kode_kamar'];
$harga_kamar = @$_POST['harga_kamar'];
$status_kamar = 0;
$tgl_check_in = '0000-00-00';
$tgl_check_out = '0000-00-00';

$queries = <<<"QUERY"
            INSERT INTO tbl_kamar
            (kode_kamar, status_kamar, tgl_check_in, tgl_check_out, harga_kamar)
            VALUES
            ('$kode_kamar', '$status_kamar', '$tgl_check_in', '$tgl_check_out', '$harga_kamar')
            QUERY;
$query = $_DB->query($queries);
if ($query) {
    echo <<<"ALERT"
            <script>
            alert('Data berhasil ditambah!');
            document.location = '../dashboard.php?page=data_kamar';
            </script>
            ALERT;
}
