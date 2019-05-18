<?php
include('../koneksi.php');

$sqlLastId = mysqli_query($conn, "SELECT MAX(kode_buku) FROM buku");
$lastId = mysqli_fetch_array($sqlLastId);

if ($lastId) {
    $nilai = substr($lastId[0], 1);
    $kode = (int)$nilai;

    $kode = $kode + 10;
    $kodeNya = "B" . str_pad($kode, 4, "0", STR_PAD_LEFT);
} else {
    $kodeNya = 'B0010';
}
$sql = "INSERT INTO buku VALUES('" . $kodeNya . "', '" . $_POST['judul_buku'] . "', '" . $_POST['pengarang_buku'] . "', '" . $_POST['jumlah_buku'] . "', '" . $_POST['penerbit_buku'] . "')";
$exec = mysqli_query($conn, $sql);

if (!$exec) {
    echo "ERR - " . mysqli_error($conn);
} else {
    echo "OK";
}
