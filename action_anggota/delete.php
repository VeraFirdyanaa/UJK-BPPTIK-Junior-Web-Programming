<?php
include('../koneksi.php');

$sql = "DELETE FROM anggota WHERE id_anggota = '".$_GET['id']."'";
$exec = mysqli_query($conn, $sql);

if(!$exec) {
    echo "ERR - ".mysqli_error($conn);
} else {
    echo "OK";
}

?>