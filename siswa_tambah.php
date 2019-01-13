<div class="page-header">
    <h1>Tambah Siswa</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" value="<?=set_value('kode', kode_oto('kode_siswa', 'tb_siswa', 'S', 3))?>"/>
            </div>
            <div class="form-group">
                <label>Nama Siswa <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=set_value('nama')?>"/>
            </div>
            <div class="form-group">
                <label>Tgl Lahir <span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="tanggal_lahir" value="<?=set_value('tanggal_lahir', date('Y-m-d'))?>"/>
            </div>
            <div class="form-group">
                <label>JK <span class="text-danger">*</span></label>
                <?=get_jk_radio(set_value('jk'))?>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input class="form-control" type="text" name="alamat" value="<?=set_value('alamat')?>"/>
            </div>
            <div class="form-group">
                <label>Wali</label>
                <input class="form-control" type="text" name="wali" value="<?=set_value('wali')?>"/>
            </div>
            <div class="form-group">
                <label>Telpon</label>
                <input class="form-control" type="text" name="telpon" value="<?=set_value('telpon')?>"/>
            </div>
            <div class="form-group">
                <label>Jenis <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_terapi">
                    <?=get_terapi_option(set_value('kode_terapi'))?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=siswa"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>