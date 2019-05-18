<?php
include('../koneksi.php');
$kode = isset($_GET['id']) ? $_GET['id'] : null;

$sql = "UPDATE anggota SET nama_anggota = '".$_POST['nama_anggota']."', alamat_anggota = '".$_POST['alamat_anggota']."', status_anggota = '".$_POST['status_anggota']."' WHERE id_anggota = '".$kode."' ";
$exec = mysqli_query($conn, $sql);

if(!$exec) {
    echo "ERR - ".mysqli_error($conn);
} else {
    echo "OK";
}

?>