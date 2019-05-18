<?php
include('../koneksi.php');

$sql = "DELETE FROM buku WHERE kode_buku = '".$_GET['id']."'";
$exec = mysqli_query($conn, $sql);

if(!$exec) {
    echo "ERR - ".mysqli_error($conn);
} else {
    echo "OK";
}

?>