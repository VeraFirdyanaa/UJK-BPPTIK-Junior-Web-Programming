<?php
include('koneksi.php');
$id_anggota = isset($_GET['id_anggota']) ? $_GET['id_anggota'] : '';

$sql = "SELECT * FROM anggota WHERE id_anggota = '".$id_anggota."'";
$exec = mysqli_query($conn, $sql);
$anggota = mysqli_fetch_assoc($exec);

include('admin_header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Edit Anggota</h2>
            <div id="formCollapse" class="row mt-4 mb-4">
                <div class="col-md-12">
                    <div class="card card-body">
                        <h4 class="text-center">Edit Anggota </h4>
                        <div class="form-group">
                            <label for="Nama Anggota">Nama Anggota</label>
                            <input type="text" name="nama_anggota" id="nama_anggota" class="form-control" value="<?php echo $anggota['nama_anggota'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="Alamat Anggota">Alamat Anggota</label>
                            <textarea name="alamat_anggota" id="alamat_anggota" class="form-control"><?php echo $anggota['alamat_anggota'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Status Anggota">Status Anggota</label>
                            <select name="status_anggota" id="status_anggota" class="form-control">
                                <option value="Mahasiswa" <?php echo $anggota['status_anggota'] === 'Mahasiswa' ? 'selected' : null ?>>Mahasiswa</option>
                                <option value="Pelajar" <?php echo $anggota['status_anggota'] === 'Pelajar' ? 'selected' : null ?>>Pelajar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" id="simpan_anggota" class="btn btn-primary">Simpan</button>
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
    $('#simpan_anggota').click(function(){
        $.post('action_anggota/update.php?id=<?php echo $anggota['id_anggota']; ?>', {
            nama_anggota: $('#nama_anggota').val(),
            alamat_anggota: $('#alamat_anggota').val(),
            status_anggota: $('#status_anggota').val(),
        }, function(data){
            console.log('its data', data);
            if(data === 'OK') {
                alert('Berhasil Menyimpan Anggota');
                window.open("data_anggota.php", "_self");
            } else {
                alert('Gagal Menyimpan Anggota!');
            }
        }).fail(function(err){
            console.log('its err')
        });
    });
});
</script>
