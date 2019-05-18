<?php
include('../koneksi.php');

$sql = "INSERT INTO peminjaman VALUES(NULL,'".$_POST['id_anggota']."', '".$_POST['kode_buku']."', DATE('".$_POST['tanggal_pinjam']."'), DATE('".$_POST['tanggal_kembali']."'), '".$_POST['lama_pinjam']."', '".$_POST['keadaan_buku']."')";
$exec = mysqli_query($conn, $sql);

if(!$exec) {
    echo "ERR - ".mysqli_error($conn);
} else {
    echo "OK";
}

?>