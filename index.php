<?php
include('koneksi.php');
$judul_buku = isset($_GET['judul_buku']) ? $_GET['judul_buku'] : '';

$sql = "SELECT * FROM buku WHERE judul_buku LIKE '%" . $judul_buku . "%'";
$exec = mysqli_query($conn, $sql);

include('header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Data Buku</h2>
            <div class="row">
                <div class="col-md-6">
                    <form action="index.php" method="get">
                        <div class="form-group">
                            <label for="">Cari Buku</label>
                            <input type="text" name="judul_buku" class="form-control" value="<?php echo isset($_GET['judul_buku']) ? $_GET['judul_buku'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table table-striped table-hovered">
                <thead>
                    <tr>
                        <th>Kode Buku</th>
                        <th>Judul Buku</th>
                        <th>Pengarang Buku</th>
                        <th>Jumlah Buku</th>
                        <th>Penerbit Buku</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $buku = array();
                    while ($row = mysqli_fetch_assoc($exec)) { ?>
                        <tr>
                            <td><?php echo $row['kode_buku'] ?></td>
                            <td><?php echo $row['judul_buku'] ?></td>
                            <td><?php echo $row['pengarang_buku'] ?></td>
                            <td><?php echo $row['jumlah_buku'] ?></td>
                            <td><?php echo $row['penerbit_buku'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('footer.php') ?>