<div class="page-header">
    <h1>Tambah Terapis</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" value="<?=set_value('kode', kode_oto('kode_terapis', 'tb_terapis', 'T', 3))?>"/>
            </div>
            <div class="form-group">
                <label>Nama Terapis <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=$_POST['nama']?>"/>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input class="form-control" type="text" name="alamat" value="<?=$_POST['alamat']?>"/>
            </div>
            <div class="form-group">
                <label>Telpon</label>
                <input class="form-control" type="text" name="telpon" value="<?=$_POST['telpon']?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=terapis"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>