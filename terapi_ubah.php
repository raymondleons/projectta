<?php
    $row = $db->get_row("SELECT * FROM tb_terapi WHERE kode_terapi='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1>Ubah Terapi</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" readonly="readonly" value="<?=$row->kode_terapi?>"/>
            </div>
            <div class="form-group">
                <label>Nama Terapi <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=$row->nama_terapi?>"/>
            </div>
            <div class="form-group">
                <label>Semester</label>
                <input class="form-control" type="text" name="semester" value="<?=$row->semester?>" />
            </div>
            <div class="form-group">
                <label>Jenis</label>
                <select class="form-control" name="jenis">
                    <?=get_jenis_option($row->jenis)?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=terapi"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>