<?php
include('koneksi.php');
$kode_buku = isset($_GET['kode_buku']) ? $_GET['kode_buku'] : '';

$sql = "SELECT * FROM buku WHERE kode_buku = '".$kode_buku."'";
$exec = mysqli_query($conn, $sql);
$buku = mysqli_fetch_assoc($exec);

include('admin_header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit Buku</h2>
            <div id="formCollapse" class="row mt-4 mb-4">
                <div class="col-md-12">
                    <div class="card card-body">
                        <h4 class="text-center">Edit Buku <?php echo $buku['judul_buku']; ?></h4>
                        <div class="form-group">
                            <label for="Judul Buku">Judul Buku</label>
                            <input type="text" name="judul_buku" id="judul_buku" class="form-control" value="<?php echo $buku['judul_buku']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="Pengarang Buku">Pengarang Buku</label>
                            <input type="text" name="pengarang_buku" id="pengarang_buku" class="form-control" value="<?php echo $buku['pengarang_buku']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="Jumlah Buku">Jumlah Buku</label>
                            <input type="number" name="jumlah_buku" id="jumlah_buku" class="form-control" value="<?php echo $buku['jumlah_buku']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="Penerbit Buku">Penerbit Buku</label>
                            <input type="text" name="penerbit_buku" id="penerbit_buku" class="form-control" value="<?php echo $buku['penerbit_buku']; ?>">
                        </div>
                        <div class="form-group">
                            <button type="button" id="simpan_buku" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('admin_footer.php'); ?>

<script>

$(document).ready(function(){
    $('#simpan_buku').click(function(){
        $.post('action_buku/update.php?id=<?php echo $buku['kode_buku']; ?>', {
            judul_buku: $('#judul_buku').val(),
            pengarang_buku: $('#pengarang_buku').val(),
            jumlah_buku: $('#jumlah_buku').val(),
            penerbit_buku: $('#penerbit_buku').val(),
        }, function(data){
            console.log('its data', data);
            if(data === 'OK') {
                alert('Berhasil Menyimpan Buku');
                window.open("data_buku.php", "_self");
            } else {
                alert('Gagal Menyimpan BUku!');
            }
        }).fail(function(err){
            console.log('its err')
        });
    });
});
</script>
