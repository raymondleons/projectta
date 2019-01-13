<div class="page-header">
    <h1>Hari</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="hari" />
            <div class="form-group">
                    <input class="form-control" type="text" name="q" value="<?=$_GET['q']?>" placeholder="Pencarian..." />
                </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Cari</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=hari_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="nw">
                <th>Kode Hari</th>
                <th>Nama Hari</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT *
            FROM tb_hari j
            ORDER BY j.`kode_hari`");
        foreach($rows as $row):?>
        <tr>
            <td><?=$row->kode_hari?></td>
            <td><?=$row->nama_hari?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=hari_ubah&ID=<?=$row->kode_hari?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=hari_hapus&ID=<?=$row->kode_hari?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;
        ?>
        </table>
    </div>    
</div>