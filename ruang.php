<div class="page-header">
    <h1>Ruang</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="ruang" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Cari</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=ruang_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Ruang</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_ruang 
        WHERE kode_ruang LIKE '%$q%' OR nama_ruang LIKE '%$q%' OR jenis LIKE '%$q%' 
        ORDER BY kode_ruang");
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><?=$row->kode_ruang ?></td>
            <td><?=$row->nama_ruang?></td>
            <td><?=$row->jenis?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=ruang_ubah&ID=<?=$row->kode_ruang?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=ruang_hapus&ID=<?=$row->kode_ruang?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
    </div>
</div>