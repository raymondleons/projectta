<div class="page-header">
    <h1>Jam</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="jam" />
            <div class="form-group">
                <input class="form-control" type="text" name="q" value="<?=$_GET['q']?>" placeholder="Pencarian..." />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Cari</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=jam_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="nw">
                <th>Kode Jam</th>
                <th>Nama Jam</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT *
            FROM tb_jam j WHERE kode_jam LIKE '%$q%' OR nama_jam LIKE '%$q%'
            ORDER BY j.`kode_jam`");
        $no=0;
        
        foreach($rows as $row):?>
        <tr>
            <td><?=$row->kode_jam?></td>
            <td><?=$row->nama_jam?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=jam_ubah&ID=<?=$row->kode_jam?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=jam_hapus&ID=<?=$row->kode_jam?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;
        ?>
        </table>
    </div>
</div>