<?php
session_start();
require '../connection.php';

$username = @$_POST['username'];
$password = md5(@$_POST['password']);

$user = $_DB->query("SELECT * FROM tbl_user WHERE username='$username'");

if ($user->num_rows > 0) {
    $user = $user->fetch_all(MYSQLI_ASSOC)[0];
    if ($user['password'] != $password) {
        die(
            alertReturn(
                'Username atau Password salah!',
                '../index.php'
            )
        );
    } else {
        $_SESSION['user'] = $user;
        die(
            alertReturn(
                'Anda berhasil login!',
                '../dashboard.php'
            )
        );
    }
} else {
    die(
        alertReturn(
            'Username atau Password salah!',
            '../index.php'
        )
    );
}
