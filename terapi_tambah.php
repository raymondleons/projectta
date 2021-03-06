<div class="page-header">
    <h1>Tambah Terapi</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" value="<?=set_value('kode', kode_oto('kode_terapi', 'tb_terapi', 'TR', 3))?>"/>
            </div>
            <div class="form-group">
                <label>Nama Terapi <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=$_POST['nama']?>"/>
            </div>
            <div class="form-group">
                <label>Semester</label>
                <input class="form-control" type="text" name="semester" value="<?=$_POST['semester']?>"/>
            </div>
            <div class="form-group">
                <label>Jenis</label>
                <select class="form-control" name="jenis">
                    <?=get_jenis_option($_POST['jenis'])?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=terapi"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>