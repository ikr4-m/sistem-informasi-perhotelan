<?php
$_DB = new mysqli(
    'localhost',
    'root',
    'root',
    'latihan_hotel'
);

if ($_DB->connect_error) {
    die($_DB->error);
}

function alertReturn ($alert, $url)
{
    return <<<"ALERT"
              <script>
              alert('$alert');
              document.location = '$url'
              </script>
              ALERT;
}
