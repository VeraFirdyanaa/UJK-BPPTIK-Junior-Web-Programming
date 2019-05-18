<?php
include('koneksi.php');
$judul_buku = isset($_GET['judul_buku']) ? $_GET['judul_buku'] : '';

$sql = "SELECT * FROM buku WHERE judul_buku LIKE '%".$judul_buku."%'";
$exec = mysqli_query($conn, $sql);

include('admin_header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Kelola Buku</h2>
            <div class="row">
                <div class="col-md-6">
                    <form action="data_buku.php" method="get">
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
            <div class="row">
                <div class="col-md-6 offset-md-3 mb-4">
                    <button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#formCollapse" aria-expanded="false" aria-controls="formCollapse">Tambah Buku</button>
                </div>
            </div>
            <div id="formCollapse" class="collapse row mt-4 mb-4">
                <div class="col-md-12">
                    <div class="card card-body">
                        <h4 class="text-center">Tambah Buku Baru</h4>
                        <div class="form-group">
                            <label for="Judul Buku">Judul Buku</label>
                            <input type="text" name="judul_buku" id="judul_buku" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Pengarang Buku">Pengarang Buku</label>
                            <input type="text" name="pengarang_buku" id="pengarang_buku" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Jumlah Buku">Jumlah Buku</label>
                            <input type="number" name="jumlah_buku" id="jumlah_buku" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Penerbit Buku">Penerbit Buku</label>
                            <input type="text" name="penerbit_buku" id="penerbit_buku" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" id="simpan_buku" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($exec)) { ?>
                            <tr>
                                <td><?php echo $row['kode_buku'] ?></td>
                                <td><?php echo $row['judul_buku'] ?></td>
                                <td><?php echo $row['pengarang_buku'] ?></td>
                                <td><?php echo $row['jumlah_buku'] ?></td>
                                <td><?php echo $row['penerbit_buku'] ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="edit_buku.php?kode_buku=<?php echo $row['kode_buku'] ?>" class="btn btn-info btn-sm">Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusBuku('<?php echo $row['kode_buku']; ?>')">Hapus</button>
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

function hapusBuku(kode_buku) {
    console.log(kode_buku);
    $.get('action_buku/delete.php?id='+kode_buku, function(data){
        console.log('its data', data);
        if(data === 'OK') {
            alert('Berhasil Menghapus Buku');
            location.reload();
        } else {
            alert('Gagal Menghapus BUku!');
        }
    }).fail(function(err){
        console.log('its err')
    });
}

$(document).ready(function(){
    $('#simpan_buku').click(function(){
        $.post('action_buku/tambah.php', {
            judul_buku: $('#judul_buku').val(),
            pengarang_buku: $('#pengarang_buku').val(),
            jumlah_buku: $('#jumlah_buku').val(),
            penerbit_buku: $('#penerbit_buku').val(),
        }, function(data){
            console.log('its data', data);
            if(data === 'OK') {
                alert('Berhasil Menambahkan Buku');
                location.reload();
            } else {
                alert('Gagal Menambahkan BUku!');
            }
        }).fail(function(err){
            console.log('its err')
        });
    });
});
</script>
