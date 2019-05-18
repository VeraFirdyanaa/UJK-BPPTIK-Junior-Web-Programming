<?php
include('../koneksi.php');

$sqlLastId = mysqli_query($conn, "SELECT MAX(id_anggota) FROM anggota");
$lastId = mysqli_fetch_array($sqlLastId);

if ($lastId) {
    $nilai = substr($lastId[0], 1);
    $kode = (int)$nilai;

    $kode = $kode + 10;
    $kodeNya = "A" . str_pad($kode, 4, "0", STR_PAD_LEFT);
} else {
    $kodeNya = 'A0010';
}
$sql = "INSERT INTO anggota VALUES('" . $kodeNya . "', '" . $_POST['nama_anggota'] . "', '" . $_POST['alamat_anggota'] . "', '" . $_POST['status_anggota'] . "')";
$exec = mysqli_query($conn, $sql);

if (!$exec) {
    echo "ERR - " . mysqli_error($conn);
} else {
    echo "OK";
}
