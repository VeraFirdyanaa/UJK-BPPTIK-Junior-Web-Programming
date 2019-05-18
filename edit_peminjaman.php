<?php
include('koneksi.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';

$sql = "SELECT * FROM peminjaman WHERE id = '" . $id . "'";
$exec = mysqli_query($conn, $sql);
$peminjaman = mysqli_fetch_assoc($exec);

include('admin_header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit Peminjaman</h2>
            <div id="formCollapse" class="row mt-4 mb-4">
                <div class="col-md-12">
                    <div class="card card-body">
                        <h4 class="text-center">Edit Peminjaman </h4>
                        <div class="form-group">
                            <label for="id anggota">Id Anggota</label>
                            <input type="text" name="id_anggota" id="id_anggota" class="form-control" value="<?php echo $peminjaman['id_anggota'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="Kode Buku">Kode Buku</label>
                            <textarea name="kode_buku" id="kode_buku" class="form-control"><?php echo $peminjaman['kode_buku'] ?></textarea>
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
        </div>
    </div>
</div>
<?php include('admin_footer.php'); ?>

<script>
    $(document).ready(function() {
        $('#simpan_peminjaman').click(function() {
            var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
            var firstDate = new Date($('#tanggal_pinjam').val());
            var secondDate = new Date($('#tanggal_kembali').val());

            var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime()) / (oneDay)));
            $.post('action_peminjaman/update.php?id=<?php echo $peminjaman['id']; ?>', {
                id_anggota: $('#id_anggota').val(),
                kode_buku: $('#kode_buku').val(),
                tanggal_pinjam: $('#tanggal_pinjam').val(),
                tanggal_kembali: $('#tanggal_kembali').val(),
                lama_pinjam: diffDays,
                keadaan_buku: $('#keadaan_buku').val(),
            }, function(data) {
                console.log('its data', data);
                if (data === 'OK') {
                    alert('Berhasil Menyimpan Peminjaman');
                    window.open("data_peminjaman.php", "_self")
                } else {
                    alert('Gagal Menambahkan Peminjaman!');
                }
            }).fail(function(err) {
                console.log('its err')
            });
        });
    });
</script>