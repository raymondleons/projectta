<div class="page-header">
    <h1>Penjadwalan</h1>
</div>
<?php
$success = true;
$a = 10;
$b = 25;
$c = 75;
$d = 25;

if(isset($_GET['num_kromosom'])) {
    $num_kromosom = $_GET['num_kromosom'];
    if($num_kromosom<$a || $num_kromosom>500) {
        print_msg("Masukkan jumlah kromosom dari $a sampai 500");
        $success = false;
    }   
    
    $max_generation = $_GET['max_generation'];
    if($max_generation<$b || $max_generation>500) {
        print_msg("Masukkan maksimal generasi dari $b sampai 500");
        $success = false;
    } 
    
    $crossover_rate = $_GET['crossover_rate'];
    if($crossover_rate<1 || $crossover_rate>100) {
        print_msg("Masukkan dari 1 sampai 100");
        $success = false;
    } 
    
    $mutation_rate = $_GET['mutation_rate'];
    if($mutation_rate<1 || $mutation_rate>100) {
        print_msg("Masukkan dari 1 sampai 100");
        $success = false;
    } 
} else {
    $num_kromosom = $a;
    $max_generation = $b;
    $crossover_rate = $c;
    $mutation_rate = $d;
}
?>
<div class="row">
    <div class="col-md-6">
        <form action="?">
            <input type="hidden" name="m" value="hitung" />
            <div class="form-group">
                <label>Jumlah Kromosom Dibangkitkan</label>
                <input class="form-control" type="text" name="num_kromosom" value="<?=$num_kromosom?>" />
                <p class="help-block">Masukkan antara <?=$a?>-500</p>
            </div>
            <div class="form-group">
                <label>Maksimal Generasi</label>
                <input class="form-control" type="text" name="max_generation" value="<?=$max_generation?>" />
                <p class="help-block">Masukkan antara <?=$b?>-500</p>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="debug" <?=(isset($_GET['debug'])) ? 'checked' : ''?> name="debug" /> Tampilkan proses algoritma
                </label>
            </div>
            <a class="btn btn-info" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
              Opsi Lain
            </a>
            <div class="collapse" id="collapseExample">
            <hr />
                <div class="well">
                    Total Siswa: <?=$db->get_var("SELECT COUNT(*) FROM tb_siswa")?><br />
                    Total Waktu: <?=$db->get_var("SELECT COUNT(*) FROM tb_waktu")?><br />
                    Total Ruang: <?=$db->get_var("SELECT COUNT(*) FROM tb_ruang")?>
                </div>
                <div class="form-group">
                    <label>Crossover Rate</label>
                    <input class="form-control" type="text" name="crossover_rate" value="<?=$crossover_rate?>" />
                    <p class="help-block">Masukkan antara 1-100</p>
                </div>   
                <div class="form-group">
                    <label>Mutation Rate</label>
                    <input class="form-control" type="text" name="mutation_rate" value="<?=$mutation_rate?>" />
                    <p class="help-block">Masukkan antara 1-100</p>
                </div>
            </div>                                    
            <button class="btn btn-primary">Generate Jadwal</button> 
            <?php if($success && isset($_GET['num_kromosom'])) :?>
            <a class="btn btn-success" href="?m=hitung_hasil" target="_blank">Lihat Jadwal</a>
            <?php endif ?>           
        </form>
    </div>
</div>
<?php
include 'ag.php';

if($success && isset($_GET['num_kromosom'])) {
    echo '<hr />';
    
    $arrRuang =  $db->get_results("SELECT kode_ruang, jenis FROM tb_ruang");
    $arrWaktu = $db->get_results("SELECT w.*
    FROM tb_waktu w INNER JOIN tb_hari h ON h.kode_hari=w.kode_hari INNER JOIN tb_jam j ON j.kode_jam=w.kode_jam
    WHERE status_waktu='Tersedia'
    ORDER BY w.kode_waktu");

    $arrSiswa = $db->get_results("SELECT s.kode_siswa, t.kode_terapi, t.jenis FROM tb_siswa s INNER JOIN tb_terapi t ON t.kode_terapi=s.kode_terapi ORDER BY kode_siswa");
    $arrTerapis = $db->get_results("SELECT kode_terapis FROM tb_terapis ORDER BY kode_terapis");

    //echo '<pre>';
    $ag = new AG($arrSiswa, $arrWaktu, $arrRuang, $arrTerapis);
    $ag->num_crommosom = $num_kromosom;
    $ag->max_generation = $max_generation;
    $ag->debug = $_GET['debug'];
        
    $ag->crossover_rate = $crossover_rate;
    $ag->generate();
    //echo '</pre>';
}
?>