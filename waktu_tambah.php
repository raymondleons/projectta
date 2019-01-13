<div class="page-header">
    <h1>Tambah Waktu</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=waktu_tambah">
            <div class="form-group">
                <label>Terapis <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_terapis">
                    <option value=""></option>
                    <?=AG_get_terapis_option($_POST['kode_terapis'])?>
                </select>
            </div>
            <div class="form-group">
                <label>Hari <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_hari">
                    <option value=""></option>
                    <?=AG_get_hari_option($_POST['kode_hari'])?>
                </select>
            </div>
            <div class="form-group">
                <label>Jam <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_jam">
                    <option value=""></option>
                    <?=AG_get_jam_option(set_value('kode_jam'))?>
                </select>
            </div>
            <div class="form-group">
                <label>Status <span class="text-danger">*</span></label>
                <select class="form-control" name="status_waktu">
                    <?=get_status_waktu_option(set_value('status_waktu'))?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=waktu"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>