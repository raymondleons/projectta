<h1>Jadwal Terapi</h1>
<table class="table table-bordered table-hover table-striped">
    <thead>
        <tr class="nw">
            <th>No</th>
            <th>Hari</th>
            <th>Jam</th>
            <th>Siswa</th>
            <th>Terapi</th>
            <th>Terapis</th>
            <th>Ruang</th>
        </tr>
    </thead>
    <?php
    $q = esc_field($_GET['q']);
    $rows = $db->get_results("SELECT h.nama_hari, j2.nama_jam, s.nama_siswa, t.nama_terapi, t2.nama_terapis, r.nama_ruang
    FROM tb_jadwal j
        INNER JOIN tb_siswa s ON s.kode_siswa=j.kode_siswa
        INNER JOIN tb_waktu w ON w.kode_waktu=j.kode_waktu
        INNER JOIN tb_hari h ON h.kode_hari=w.kode_hari
        INNER JOIN tb_jam j2 ON j2.kode_jam=w.kode_jam
        INNER JOIN tb_terapi t ON t.kode_terapi=s.kode_terapi
        INNER JOIN tb_terapis t2 ON t2.kode_terapis=w.kode_terapis
        INNER JOIN tb_ruang r ON r.kode_ruang=j.kode_ruang
    WHERE nama_hari LIKE '%$q' 
        OR nama_siswa LIKE '%$q' 
        OR nama_terapi LIKE '%$q' 
        OR nama_terapis LIKE '%$q' 
        OR nama_ruang LIKE '%$q' 
    ORDER BY h.kode_hari, j2.kode_jam");
    $no=0;

    foreach($rows as $row):?>
    <tr>
        <td><?=++$no ?></td>
        <td><?=$row->nama_hari?></td>
        <td><?=substr($row->nama_jam, 0, 5)?></td>
        <td><?=$row->nama_siswa?></td>
        <td><?=$row->nama_terapi?></td>
        <td><?=$row->nama_terapis?></td>
        <td><?=$row->nama_ruang?></td>
    </tr>
    <?php endforeach;?>
</table>