<div class="page-header">
    <h1>Siswa</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="siswa" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Cari</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=siswa_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Siswa</th>
                <th>Tgl Lahir</th>
                <th>JK</th>
                <th>Alamat</th>
                <th>Wali</th>
                <th>Telpon</th>
                <th>Terapi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tb_siswa s LEFT JOIN tb_terapi t ON t.kode_terapi=s.kode_terapi
        WHERE kode_siswa LIKE '%$q%' OR nama_siswa LIKE '%$q%'
        ORDER BY kode_siswa");
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><?=$row->kode_siswa?></td>
            <td><?=$row->nama_siswa?></td>
            <td><?=$row->tanggal_lahir?></td>
            <td><?=$row->jk?></td>
            <td><?=$row->alamat?></td>
            <td><?=$row->wali?></td>
            <td><?=$row->telpon?></td>
            <td><?=$row->nama_terapi?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=siswa_ubah&ID=<?=$row->kode_siswa?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=siswa_hapus&ID=<?=$row->kode_siswa?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
    </div>
</div>