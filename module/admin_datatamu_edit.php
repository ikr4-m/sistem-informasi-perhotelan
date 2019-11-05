<?php
require '../connection.php';
$id_tamu = @$_POST['id_tamu'];
$nama = @$_POST['nama'];
$alamat = @$_POST['alamat'];
$pekerjaan = @$_POST['pekerjaan'];
$no_telp = @$_POST['no_telp'];

// Kalau tidak ada, update
$query = $_DB->query(<<<"QUERY"
                        UPDATE tbl_tamu SET
                        nama='$nama', alamat='$alamat', pekerjaan='$pekerjaan',
                        no_telp='$no_telp'
                        WHERE id_tamu='$id_tamu'
                        QUERY);
if ($query) {
  echo alertReturn(
      'Data berhasil di update!',
      '../dashboard.php?page=data_tamu'
  );
}
