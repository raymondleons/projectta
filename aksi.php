<?php
require_once'functions.php';

/** LOGIN */ 
if ($mod=='login'){
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);
    
    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$user' AND pass='$pass'")or die(mysql_error());
    if($row){
        $_SESSION['login'] = $row->user;
        redirect_js("index.php");
    } else{
        print_msg("Salah kombinasi username dan password.");
    }          
} else if ($mod=='password'){
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    $pass3 = $_POST['pass3'];
    
    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$_SESSION[login]' AND pass='$pass1'");        
    
    if($pass1=='' || $pass2=='' || $pass3=='')
        print_msg('Field bertanda * harus diisi.');
    elseif(!$row)
        print_msg('Password lama salah.');
    elseif( $pass2 != $pass3 )
        print_msg('Password baru dan konfirmasi password baru tidak sama.');
    else{        
        $db->query("UPDATE tb_admin SET pass='$pass2' WHERE user='$_SESSION[login]'");                    
        print_msg('Password berhasil diubah.', 'success');
    }
} elseif($act=='logout'){
    unset($_SESSION['login']);
    header("location:index.php?m=login");
}

/** JAM */    
if($mod=='jam_tambah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    
    if($kode=='' || $nama=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_jam WHERE kode_jam='$kode'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_jam (kode_jam, nama_jam) VALUES ('$kode', '$nama')");                                    
        redirect_js("index.php?m=jam");
    }                    
} else if($mod=='jam_ubah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    
    if($kode=='' || $nama=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_jam SET nama_jam='$nama'WHERE kode_jam='$_GET[ID]'");
        redirect_js("index.php?m=jam");
    }    
} else if ($act=='jam_hapus'){
    $db->query("DELETE FROM tb_jam WHERE kode_jam='$_GET[ID]'");
    $db->query("DELETE FROM tb_waktu WHERE kode_jam='$_GET[ID]'"); 
    header("location:index.php?m=jam");
} 

/** HARI */    
if($mod=='hari_tambah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    
    if($kode=='' || $nama=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_hari WHERE kode_hari='$kode'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_hari (kode_hari, nama_hari) VALUES ('$kode', '$nama')");                                    
        redirect_js("index.php?m=hari");
    }                    
} else if($mod=='hari_ubah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    
    if($kode=='' || $nama=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_hari SET nama_hari='$nama'WHERE kode_hari='$_GET[ID]'");
        redirect_js("index.php?m=hari");
    }    
} else if ($act=='hari_hapus'){
    $db->query("DELETE FROM tb_hari WHERE kode_hari='$_GET[ID]'");
    $db->query("DELETE FROM tb_waktu WHERE kode_hari='$_GET[ID]'"); 
    header("location:index.php?m=hari");
} 

/** WAKTU */	
elseif($mod=='waktu_tambah'){
    $kode_terapis  = $_POST['kode_terapis'];
    $kode_hari   = $_POST['kode_hari'];  
    $kode_jam   = $_POST['kode_jam'];   
    $status_waktu   = $_POST['status_waktu'];         

    if($kode_terapis=='' || $kode_hari=='' || $kode_jam=='')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif($db->get_row("SELECT * FROM tb_waktu WHERE kode_terapis='$kode_terapis' AND kode_hari='$kode_hari' AND kode_jam='$kode_jam'"))
        print_msg("Kombinasi hari dan jam sudah ada!");
    else{
        $db->query("INSERT INTO tb_waktu (kode_terapis, kode_hari, kode_jam, status_waktu) 
            VALUES ('$kode_terapis', '$kode_hari', '$kode_jam', '$status_waktu')");                       
        redirect_js("index.php?m=waktu");
    }
} else if($mod=='waktu_ubah'){
    $kode_terapis  = $_POST['kode_terapis'];
    $kode_hari   = $_POST['kode_hari'];  
    $kode_jam   = $_POST['kode_jam'];   
    $status_waktu   = $_POST['status_waktu'];        

    if($kode_terapis=='' || $kode_hari=='' || $kode_jam=='')
        print_msg("Field yang bertanda * tidak boleh kosong!");
    elseif($db->get_row("SELECT * FROM tb_waktu WHERE kode_terapis='$kode_terapis' AND kode_hari='$kode_hari' AND kode_jam='$kode_jam' AND kode_waktu<>'$_GET[ID]'"))
        print_msg("Kombinasi hari dan jam sudah ada!");
    else{
        $db->query("UPDATE tb_waktu 
            SET kode_hari='$kode_terapis', kode_hari='$kode_hari', kode_jam='$kode_jam', status_waktu='$status_waktu'
            WHERE kode_waktu='$_GET[ID]'");
        redirect_js("index.php?m=waktu");
    }
} else if ($act=='waktu_hapus'){
    $db->query("DELETE FROM tb_waktu WHERE kode_waktu='$_GET[ID]'");
    header("location:index.php?m=waktu");
} 

/** ruang */    
else if($mod=='ruang_tambah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    
    if($kode=='' || $nama=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_ruang WHERE kode_ruang='$kode'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_ruang (kode_ruang, nama_ruang, jenis) VALUES ('$kode', '$nama', '$jenis')");                       
        redirect_js("index.php?m=ruang");
    }                    
} else if($mod=='ruang_ubah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    
    if($kode=='' || $nama=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_ruang SET nama_ruang='$nama', jenis='$jenis' WHERE kode_ruang='$_GET[ID]'");
        redirect_js("index.php?m=ruang");
    }    
} else if ($act=='ruang_hapus'){
    $db->query("DELETE FROM tb_ruang WHERE kode_ruang='$_GET[ID]'");
    header("location:index.php?m=ruang");
} 

/** terapis */    
if($mod=='terapis_tambah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];
    
    if($kode=='' || $nama=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_terapis WHERE kode_terapis='$kode'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_terapis (kode_terapis, nama_terapis, alamat, telpon) 
            VALUES ('$kode', '$nama', '$alamat', '$telpon')");                       
        redirect_js("index.php?m=terapis");
    }                    
} else if($mod=='terapis_ubah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];
    
    if($kode=='' || $nama=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_terapis 
            SET nama_terapis='$nama', alamat='$alamat', telpon='$telpon' 
            WHERE kode_terapis='$_GET[ID]'");
        redirect_js("index.php?m=terapis");
    }    
} else if ($act=='terapis_hapus'){
    $db->query("DELETE FROM tb_terapis WHERE kode_terapis='$_GET[ID]'");    
    header("location:index.php?m=terapis");
} 

/** siswa */    
elseif($mod=='siswa_tambah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $wali = $_POST['wali'];
    $telpon = $_POST['telpon'];
    $kode_terapi = $_POST['kode_terapi'];
        
    if($kode=='' || $nama=='' || $tanggal_lahir=='' || $jk=='' || $kode_terapi=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_siswa WHERE kode_siswa='$kode'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_siswa (kode_siswa, nama_siswa, tanggal_lahir, jk, alamat, wali, telpon, kode_terapi) 
            VALUES ('$kode', '$nama', '$tanggal_lahir', '$jk', '$alamat', '$wali', '$telpon', '$kode_terapi')");                       
        redirect_js("index.php?m=siswa");
    }                    
} else if($mod=='siswa_ubah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $jk = $_POST['jk'];
    $alamat = $_POST['alamat'];
    $wali = $_POST['wali'];
    $telpon = $_POST['telpon'];
    $kode_terapi = $_POST['kode_terapi'];
    
    if($kode=='' || $nama=='' || $tanggal_lahir=='' || $jk=='' || $kode_terapi=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_siswa SET nama_siswa='$nama', tanggal_lahir='$tanggal_lahir', jk='$jk', alamat='$alamat', wali='$wali', telpon='$telpon', kode_terapi='$kode_terapi'
            WHERE kode_siswa='$_GET[ID]'");
        redirect_js("index.php?m=siswa");
    }    
} else if ($act=='siswa_hapus'){
    $db->query("DELETE FROM tb_siswa WHERE kode_siswa='$_GET[ID]'");
    header("location:index.php?m=siswa");
}      
/** terapi */    
elseif($mod=='terapi_tambah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $semester = $_POST['semester'];
    $jenis = $_POST['jenis'];
    
    if($kode=='' || $nama=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    elseif($db->get_results("SELECT * FROM tb_terapi WHERE kode_terapi='$kode'"))
        print_msg("Kode sudah ada!");
    else{
        $db->query("INSERT INTO tb_terapi (kode_terapi, nama_terapi, semester, jenis) 
            VALUES ('$kode', '$nama', '$semester', '$jenis')");                       
        redirect_js("index.php?m=terapi");
    }                    
} else if($mod=='terapi_ubah'){
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $semester = $_POST['semester'];
    $jenis = $_POST['jenis'];
    
    if($kode=='' || $nama=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_terapi SET nama_terapi='$nama', semester='$semester', jenis='$jenis' 
            WHERE kode_terapi='$_GET[ID]'");
        redirect_js("index.php?m=terapi");
    }    
} else if ($act=='terapi_hapus'){
    $db->query("DELETE FROM tb_terapi WHERE kode_terapi='$_GET[ID]'");    
    header("location:index.php?m=terapi");
}  

else if($mod=='jadwal_ubah'){
    $kode_siswa = $_POST['kode_siswa'];
    $kode_waktu = $_POST['kode_waktu'];
    $kode_ruang = $_POST['kode_ruang'];

    if($kode_siswa=='' || $kode_waktu=='' || $kode_ruang=='')
        print_msg("Field bertanda * tidak boleh kosong!");
    else{
        $db->query("UPDATE tb_jadwal SET kode_siswa='$kode_siswa', kode_waktu='$kode_waktu', kode_ruang='$kode_ruang' 
            WHERE id_jadwal='$_GET[ID]'");
        redirect_js("index.php?m=hitung_hasil");
    }    
}   
