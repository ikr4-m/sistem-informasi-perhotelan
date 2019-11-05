<?php
require '../connection.php';
$id_jasa = @$_POST['id_jasa'];
$unit_jasa = @$_POST['unit_jasa'];
$harga_jasa = @$_POST['harga_jasa'];

// Tanya dulu apakah ada kode_kamar yang kembar
$query = $_DB->query("SELECT * FROM tbl_jasa WHERE unit_jasa='$unit_jasa'");
if ($query->num_rows > 0) {
    die(alertReturn(
      'Jasa ini telah tersedia',
      '../dashboard.php?page=data_jasa'
    ));
}

// Kalau tidak ada, update
$query = $_DB->query(<<<"QUERY"
                        UPDATE tbl_jasa SET
                        unit_jasa='$unit_jasa', harga_jasa='$harga_jasa'
                        WHERE id_jasa='$id_jasa'
                        QUERY);
if ($query) {
  echo alertReturn(
      'Data berhasil diubah!',
      '../dashboard.php?page=data_jasa'
  );
}
