<?php
    $row = $db->get_row("SELECT * FROM tb_terapis WHERE kode_terapis='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1>Ubah Terapis</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" readonly="readonly" value="<?=$row->kode_terapis?>"/>
            </div>
            <div class="form-group">
                <label>Nama Terapis <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=$row->nama_terapis?>"/>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input class="form-control" type="text" name="alamat" value="<?=$row->alamat?>" />
            </div>
            <div class="form-group">
                <label>Telpon</label>
                <input class="form-control" type="text" name="telpon" value="<?=$row->telpon?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=terapis"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>