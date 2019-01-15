<div class="page-header">
    <h1>Berita</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="berita" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Cari</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=v_blog_post"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Judul</th>
                <th>Isi</th>
                <th>Tanggal</th>
				<th>Slug</th>
				<th>Image</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <?php
        $q = esc_field($_GET['q']);
        $rows = $db->get_results("SELECT * FROM tbl_post 
        WHERE post_id LIKE '%$q%' OR post_judul LIKE '%$q%'
        ORDER BY post_id");
        $no=0;
        foreach($rows as $row):?>
        <tr>
            <td><?=$row->post_id?></td>
            <td><?=$row->post_judul?></td>
            <td><?=$row->post_isi?></td>
            <td><?=$row->post_tanggal?></td>
            <td><?=$row->post_slug?></td>
            <td><?=$row->post_image?></td>
            <td class="nw">
                <a class="btn btn-xs btn-warning" href="?m=terapi_ubah&ID=<?=$row->post_id?>"><span class="glyphicon glyphicon-edit"></span></a>
                <a class="btn btn-xs btn-danger" href="aksi.php?act=terapi_hapus&ID=<?=$row->post_id?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
    </div>
</div>