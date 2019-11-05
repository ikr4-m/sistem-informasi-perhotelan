<?php
require '../connection.php';
$nama = @$_POST['nama'];
$id_kamar = @$_POST['id_kamar'];
$alamat = @$_POST['alamat'];
$pekerjaan = @$_POST['pekerjaan'];
$no_telp = @$_POST['no_telp'];
$status = 1;
$tgl_check_in = date('Y-m-d');

// Buat dulu statusnya jadi 1 di kamarnya
$query = $_DB->query(<<<"QUERY"
                        UPDATE tbl_kamar SET
                        status_kamar='1', tgl_check_in='$tgl_check_in'
                        WHERE id_kamar='$id_kamar'
                        QUERY);
$query = $_DB->query(<<<"QUERY"
                        INSERT INTO tbl_tamu
                        (nama, alamat, pekerjaan, no_telp, id_kamar, status)
                        VALUES
                        ('$nama','$alamat','$pekerjaan','$no_telp','$id_kamar','$status')
                        QUERY);

// Buat loginnya
// Catatan, passwordnya itu tanggal masuknya seperti tanggal tgl_check_in
// dan usernamenya seperti kode kamarnya
$username = $_DB->query("SELECT * FROM tbl_kamar WHERE id_kamar='$id_kamar'")
    ->fetch_all(MYSQLI_ASSOC)[0]['kode_kamar'];
$password = md5(date('Ymd'));
$id_tamu = $_DB->query(<<<"QUERY"
                            SELECT * FROM tbl_tamu WHERE
                            nama='$nama' AND alamat='$alamat' AND pekerjaan='$pekerjaan' AND no_telp='$no_telp' AND
                            id_kamar='$id_kamar' AND status='$status' 
                            QUERY)
    ->fetch_all(MYSQLI_ASSOC)[0]['id_tamu'];
$query = $_DB->query(<<<"QUERY"
                        INSERT INTO tbl_user
                        (username, password, user_level, id_tamu)
                        VALUES
                        ('$username', '$password', 'USER', '$id_tamu')
                        QUERY);
if ($query) {
    echo alertReturn(
        'Data berhasil ditambah!',
        '../dashboard.php?page=data_tamu'
    );
}
