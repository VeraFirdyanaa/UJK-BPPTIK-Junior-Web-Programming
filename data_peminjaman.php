<?php
include('koneksi.php');
// $nama_peminjaman = isset($_GET['nama_peminjaman']) ? $_GET['nama_peminjaman'] : '';

$sql = "SELECT peminjaman.*, anggota.nama_anggota FROM peminjaman LEFT JOIN anggota ON peminjaman.id_anggota = anggota.id_anggota";
$exec = mysqli_query($conn, $sql);

include('admin_header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Kelola Peminjaman</h2>
            <!-- <div class="row">
                <div class="col-md-6">
                    <form action="data_peminjaman.php" method="get">
                        <div class="form-group">
                            <label for="">Cari Nama Peminjam</label>
                            <input type="text" name="nama_peminjaman" class="form-control" value="<?php echo isset($_GET['nama_peminjaman']) ? $_GET['nama_peminjaman'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                </div>
            </div> -->
            <div class="row">
                <div class="col-md-6 offset-md-3 mb-4">
                    <button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#formCollapse" aria-expanded="false" aria-controls="formCollapse">Tambah Peminjaman</button>
                </div>
            </div>
            <div id="formCollapse" class="collapse row mt-4 mb-4">
                <div class="col-md-12">
                    <div class="card card-body">
                        <h4 class="text-center">Tambah Peminjaman Baru</h4>
                        <div class="form-group">
                            <label for="ID Anggota">ID Anggota</label>
                            <input type="text" name="id_anggota" id="id_anggota" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Kode Buku">Kode Buku</label>
                            <input name="kode_buku" id="kode_buku" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="Tanggal Pinjam">Tanggal Pinjam</label>
                            <input class="form-control" type="date" name="tanggal_pinjam" id="tanggal_pinjam">
                        </div>
                        <div class="form-group">
                            <label for="Tanggal Kembali">Tanggal Kembali</label>
                            <input class="form-control" type="date" name="tanggal_kembali" id="tanggal_kembali">
                        </div>
                        <div class="form-group">
                            <label for="Keadaan Buku">Keadaan Buku</label>
                            <input type="text" name="keadaan_buku" id="keadaan_buku" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" id="simpan_peminjaman" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hovered">
                <thead>
                    <tr>
                        <th>ID Anggota</th>
                        <th>Nama Anggota</th>
                        <th>Kode Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th>Lama Pinjam</th>
                        <th>Keadaan Buku</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($exec)) { ?>
                        <tr>
                            <td><?php echo $row['id_anggota'] ?></td>
                            <td><?php echo $row['nama_anggota'] ?></td>
                            <td><?php echo $row['kode_buku'] ?></td>
                            <td><?php echo date("d F y", strtotime($row['tgl_pinjam'])); ?></td>
                            <td><?php echo date("d F y", strtotime($row['tgl_kembali'])); ?></td>
                            <td><?php echo $row['lama_pinjam'] ?> Hari</td>
                            <td><?php echo $row['keadaan_buku'] ?></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="edit_peminjaman.php?id=<?php echo $row['id'] ?>" class="btn btn-info btn-sm">Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="hapusPeminjaman('<?php echo $row['id']; ?>')">Hapus</button>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include('admin_footer.php'); ?>

<script>
    function hapusPeminjaman(id_peminjaman) {
        console.log(id_peminjaman);
        $.get('action_peminjaman/delete.php?id=' + id_peminjaman, function(data) {
            console.log('its data', data);
            if (data === 'OK') {
                alert('Berhasil Menghapus Peminjaman');
                location.reload();
            } else {
                alert('Gagal Menghapus BUku!');
            }
        }).fail(function(err) {
            console.log('its err')
        });
    }

    function editPeminjaman(id_peminjaman) {
        console.log(id_peminjaman);
    }

    $(document).ready(function() {
        $('#simpan_peminjaman').click(function() {
            var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
            var firstDate = new Date($('#tanggal_pinjam').val());
            var secondDate = new Date($('#tanggal_kembali').val());

            var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime()) / (oneDay)));
            $.post('action_peminjaman/tambah.php', {
                id_anggota: $('#id_anggota').val(),
                kode_buku: $('#kode_buku').val(),
                tanggal_pinjam: $('#tanggal_pinjam').val(),
                tanggal_kembali: $('#tanggal_kembali').val(),
                lama_pinjam: diffDays,
                keadaan_buku: $('#keadaan_buku').val(),
            }, function(data) {
                console.log('its data', data);
                if (data === 'OK') {
                    alert('Berhasil Menambahkan Peminjaman');
                    location.reload();
                } else {
                    alert('Gagal Menambahkan Peminjaman!');
                }
            }).fail(function(err) {
                console.log('its err')
            });
        });
    });
</script>