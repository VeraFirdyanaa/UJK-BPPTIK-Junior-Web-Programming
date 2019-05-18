<?php
include('koneksi.php');
$nama_anggota = isset($_GET['nama_anggota']) ? $_GET['nama_anggota'] : '';

$sql = "SELECT * FROM anggota WHERE nama_anggota LIKE '%".$nama_anggota."%'";
$exec = mysqli_query($conn, $sql);

include('admin_header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Kelola Anggota</h2>
            <div class="row">
                <div class="col-md-6">
                    <form action="data_anggota.php" method="get">
                        <div class="form-group">
                            <label for="">Cari Anggota</label>
                            <input type="text" name="nama_anggota" class="form-control" value="<?php echo isset($_GET['nama_anggota']) ? $_GET['nama_anggota'] : '' ?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3 mb-4">
                    <button class="btn btn-success btn-block" type="button" data-toggle="collapse" data-target="#formCollapse" aria-expanded="false" aria-controls="formCollapse">Tambah Anggota</button>
                </div>
            </div>
            <div id="formCollapse" class="collapse row mt-4 mb-4">
                <div class="col-md-12">
                    <div class="card card-body">
                        <h4 class="text-center">Tambah Anggota Baru</h4>
                        <div class="form-group">
                            <label for="Nama Anggota">Nama Anggota</label>
                            <input type="text" name="nama_anggota" id="nama_anggota" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="Alamat Anggota">Alamat Anggota</label>
                            <textarea name="alamat_anggota" id="alamat_anggota" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="Status Anggota">Status Anggota</label>
                            <select name="status_anggota" id="status_anggota" class="form-control">
                                <option value="Mahasiswa">Mahasiswa</option>
                                <option value="Pelajar">Pelajar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="button" id="simpan_anggota" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hovered">
                <thead>
                    <tr>
                        <th>ID Anggota</th>
                        <th>Nama Anggota</th>
                        <th>Alamat Anggota</th>
                        <th>Status Anggota</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($exec)) { ?>
                            <tr>
                                <td><?php echo $row['id_anggota'] ?></td>
                                <td><?php echo $row['nama_anggota'] ?></td>
                                <td><?php echo $row['alamat_anggota'] ?></td>
                                <td><?php echo $row['status_anggota'] ?></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="edit_anggota.php?id_anggota=<?php echo $row['id_anggota'] ?>" class="btn btn-info btn-sm">Edit</a>                                        
                                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusAnggota('<?php echo $row['id_anggota']; ?>')">Hapus</button>
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

function hapusAnggota(id_anggota) {
    console.log(id_anggota);
    $.get('action_anggota/delete.php?id='+id_anggota, function(data){
        console.log('its data', data);
        if(data === 'OK') {
            alert('Berhasil Menghapus Anggota');
            location.reload();
        } else {
            alert('Gagal Menghapus BUku!');
        }
    }).fail(function(err){
        console.log('its err')
    });
}

function editAnggota(id_anggota) {
    console.log(id_anggota);
}

$(document).ready(function(){
    $('#simpan_anggota').click(function(){
        $.post('action_anggota/tambah.php', {
            nama_anggota: $('#nama_anggota').val(),
            alamat_anggota: $('#alamat_anggota').val(),
            status_anggota: $('#status_anggota').val(),
        }, function(data){
            console.log('its data', data);
            if(data === 'OK') {
                alert('Berhasil Menambahkan Anggota');
                location.reload();
            } else {
                alert('Gagal Menambahkan Anggota!');
            }
        }).fail(function(err){
            console.log('its err')
        });
    });
});
</script>
