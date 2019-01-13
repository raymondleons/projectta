<div class="page-header">
    <h1>Waktu</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <form class="form-inline">
            <input type="hidden" name="m" value="waktu" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Cari</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=waktu_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr class="nw">
                <th>No</th>
                <th>Terapis</th>
                <th>Hari</th>
                <th>Jam</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT w.kode_waktu, w.kode_hari, w.kode_jam, h.nama_hari, j.nama_jam, t.nama_terapis, w.status_waktu
            FROM tb_waktu w 
                INNER JOIN tb_hari h ON h.kode_hari=w.kode_hari 
                INNER JOIN tb_jam j ON j.kode_jam=w.kode_jam
                INNER JOIN tb_terapis t on t.kode_terapis=w.kode_terapis
            WHERE h.nama_hari LIKE '%$q%'
            ORDER BY status_waktu, w.kode_hari, j.kode_jam");
        $no=0;
        
        foreach($rows as $row):?>
        <tr>
            <td><?=++$no ?></td>
            <td><?=$row->nama_terapis?></td>
            <td><?=$row->nama_hari?></td>
            <td><?=$row->nama_jam?></td>
            <td><?=$row->status_waktu?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=waktu_ubah&ID=<?=$row->kode_waktu?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=waktu_hapus&ID=<?=$row->kode_waktu?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach;
        ?>
        </table>
    </div>    
</div>