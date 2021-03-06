<div class="page-header">
    <h1>Terapis</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="terapis" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Cari</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=terapis_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Terapis</th>
                <th>Alamat</th>
                <th>Telpon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_terapis 
        WHERE kode_terapis LIKE '%$q%' OR nama_terapis LIKE '%$q%' OR alamat LIKE '%$q%' 
        ORDER BY kode_terapis");
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><?=$row->kode_terapis ?></td>
            <td><?=$row->nama_terapis?></td>
            <td><?=$row->alamat?></td>
            <td><?=$row->telpon?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=terapis_ubah&ID=<?=$row->kode_terapis?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=terapis_hapus&ID=<?=$row->kode_terapis?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
    </div>
</div>