<?php
include('../koneksi.php');
$kode = isset($_GET['id']) ? $_GET['id'] : null;

$sql = "UPDATE buku SET judul_buku = '".$_POST['judul_buku']."', pengarang_buku = '".$_POST['pengarang_buku']."', jumlah_buku = '".$_POST['jumlah_buku']."', penerbit_buku = '".$_POST['penerbit_buku']."' WHERE kode_buku = '".$kode."' ";
$exec = mysqli_query($conn, $sql);

if(!$exec) {
    echo "ERR - ".mysqli_error($conn);
} else {
    echo "OK";
}

?>