<?php
include('../koneksi.php');

$sql = "DELETE FROM peminjaman WHERE id = '".$_GET['id']."'";
$exec = mysqli_query($conn, $sql);

if(!$exec) {
    echo "ERR - ".mysqli_error($conn);
} else {
    echo "OK";
}

?>