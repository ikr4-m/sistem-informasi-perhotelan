<?php
require '../connection.php';
$id_kamar = @$_POST['id_kamar'];
$kode_kamar = @$_POST['kode_kamar'];
$harga_kamar = @$_POST['harga_kamar'];

// Kalau tidak ada, update
$query = $_DB->query(<<<"QUERY"
                        UPDATE tbl_kamar SET
                        kode_kamar='$kode_kamar', harga_kamar='$harga_kamar'
                        WHERE id_kamar='$id_kamar'
                        QUERY);
if ($query) {
  echo alertReturn(
      'Data berhasil di update!',
      '../dashboard.php?page=data_kamar'
  );
}
