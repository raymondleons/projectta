<?php
error_reporting(~E_NOTICE);
session_start();

ini_set('max_execution_time', 60 * 3);
ini_set('memory_limit', '128M');

include 'config.php';
include'includes/db.php';
$db = new DB($config['server'], $config['username'], $config['password'], $config['database_name']);
include'includes/general.php';
include'includes/paging.php';
    
$mod = $_GET['m'];
$act = $_GET['act']; 

function get_status_waktu_option($selected = ''){
    $arr = array('Tersedia'=> 'Tersedia', 'Tidak tersedia' => 'Tidak tersedia');

    foreach($arr as $key => $val){
        if($key==$selected)
            $a.="<option value='$key' selected>$val</option>";
        else
            $a.="<option value='$key'>$val</option>";
    }
    return $a;
}

function get_jenis_option($selected = ''){
    $arr = array('Akademik'=> 'Akademik', 'Pra Akademik' => 'Pra Akademik');

    foreach($arr as $key => $val){
        if($key==$selected)
            $a.="<option value='$key' selected>$val</option>";
        else
            $a.="<option value='$key'>$val</option>";
    }
    return $a;
}

function AG_get_hari_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_hari, nama_hari FROM tb_hari ORDER BY kode_hari");
    foreach($rows as $row){
        if($row->kode_hari==$selected)
            $a.="<option value='$row->kode_hari' selected>[$row->kode_hari] $row->nama_hari</option>";
        else
            $a.="<option value='$row->kode_hari'>[$row->kode_hari] $row->nama_hari</option>";
    }
    return $a;
}

function get_waktu_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_waktu, nama_hari, nama_jam, nama_terapis 
        FROM tb_waktu w 
            INNER JOIN tb_hari h ON h.kode_hari=w.kode_hari
            INNER JOIN tb_jam j ON j.kode_jam=w.kode_jam
            INNER JOIN tb_terapis t ON t.kode_terapis=w.kode_terapis
        WHERE status_waktu='Tersedia'");

    foreach($rows as $row){
        if($row->kode_waktu==$selected)
            $a.="<option value='$row->kode_waktu' selected>$row->nama_hari | $row->nama_jam | $row->nama_terapis</option>";
        else
            $a.="<option value='$row->kode_waktu'>$row->nama_hari | $row->nama_jam | $row->nama_terapis</option>";
    }
    return $a;
}

function get_siswa_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_siswa, nama_siswa FROM tb_siswa ORDER BY kode_siswa");
    foreach($rows as $row){
        if($row->kode_siswa==$selected)
            $a.="<option value='$row->kode_siswa' selected>[$row->kode_siswa] $row->nama_siswa</option>";
        else
            $a.="<option value='$row->kode_siswa'>[$row->kode_siswa] $row->nama_siswa</option>";
    }
    return $a;
}

function AG_get_jam_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_jam, nama_jam FROM tb_jam ORDER BY kode_jam");
    foreach($rows as $row){
        if($row->kode_jam==$selected)
            $a.="<option value='$row->kode_jam' selected>[$row->kode_jam] $row->nama_jam</option>";
        else
            $a.="<option value='$row->kode_jam'>[$row->kode_jam] $row->nama_jam</option>";
    }
    return $a;
}

function get_terapi_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_terapi, nama_terapi FROM tb_terapi ORDER BY kode_terapi");
    foreach($rows as $row){
        if($row->kode_terapi==$selected)
            $a.="<option value='$row->kode_terapi' selected>[$row->kode_terapi] $row->nama_terapi</option>";
        else
            $a.="<option value='$row->kode_terapi'>[$row->kode_terapi] $row->nama_terapi</option>";
    }
    return $a;
}

function get_ruang_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_ruang, nama_ruang FROM tb_ruang ORDER BY kode_ruang");
    foreach($rows as $row){
        if($row->kode_ruang==$selected)
            $a.="<option value='$row->kode_ruang' selected>[$row->kode_ruang] $row->nama_ruang</option>";
        else
            $a.="<option value='$row->kode_ruang'>[$row->kode_ruang] $row->nama_ruang</option>";
    }
    return $a;
}

function AG_get_terapis_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_terapis, nama_terapis FROM tb_terapis ORDER BY kode_terapis");
    foreach($rows as $row){
        if($row->kode_terapis==$selected)
            $a.="<option value='$row->kode_terapis' selected>[$row->kode_terapis] $row->nama_terapis</option>";
        else
            $a.="<option value='$row->kode_terapis'>[$row->kode_terapis] $row->nama_terapis</option>";
    }
    return $a;
}