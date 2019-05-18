<?php
include('../koneksi.php');
$kode = isset($_GET['id']) ? $_GET['id'] : null;

$sql = "UPDATE peminjaman SET id_anggota = '" . $_POST['id_anggota'] . "', kode_buku = '" . $_POST['kode_buku'] . "', tgl_pinjam = DATE('" . $_POST['tanggal_pinjam'] . "'), tgl_kembali = DATE('" . $_POST['tanggal_kembali'] . "'), lama_pinjam = '" . $_POST['lama_pinjam'] . "', keadaan_buku = '" . $_POST['keadaan_buku'] . "' WHERE id = '" . $kode . "' ";
$exec = mysqli_query($conn, $sql);

if (!$exec) {
    echo "ERR - " . mysqli_error($conn);
} else {
    echo "OK";
}
