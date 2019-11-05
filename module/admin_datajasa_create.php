<?php
require '../connection.php';
$unit_jasa = @$_POST['unit_jasa'];
$harga_jasa = @$_POST['harga_jasa'];

$queries = <<<"QUERY"
            INSERT INTO tbl_jasa
            (unit_jasa, harga_jasa)
            VALUES
            ('$unit_jasa', '$harga_jasa')
            QUERY;
$query = $_DB->query($queries);
if ($query) {
    echo alertReturn(
        'Data berhasil ditambah!',
        '../dashboard.php?page=data_jasa'
    );
}
