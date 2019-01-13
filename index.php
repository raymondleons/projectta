<?php
include 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="favicon.ico"/>

    <title>Penjadwalan Terapi</title>
    <link href="assets/css/cerulean-bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/general.css" rel="stylesheet"/>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>           
  </head>
  <body>
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?">Penjadwalan Terapi</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          <?php if($_SESSION['login']):?>
            <li><a href="?m=terapis"><span class="glyphicon glyphicon-user"></span> Terapis</a></li>       
            <li><a href="?m=terapi"><span class="glyphicon glyphicon-star"></span> Terapi</a></li> 
            <li class="dropdown">
              <a href="?m=waktu" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-time"></span> Waktu <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="?m=waktu"><span class="glyphicon glyphicon-time"></span> Data Waktu</a></li>
                <li><a href="?m=hari"><span class="glyphicon glyphicon-pushpin"></span> Hari</a></li>
                <li><a href="?m=jam"><span class="glyphicon glyphicon-pushpin"></span> Jam</a></li>
              </ul>
            </li>  
            <li><a href="?m=ruang"><span class="glyphicon glyphicon-home"></span> Ruang</a></li>
            <li><a href="?m=siswa"><span class="glyphicon glyphicon-th"></span> Siswa</a></li>
            <li><a href="?m=hitung"><span class="glyphicon glyphicon-stats"></span> Penjadwalan</a></li>   
            <li><a href="?m=hitung_hasil"><span class="glyphicon glyphicon-star"></span> Jadwal</a></li>              
            <li><a href="?m=password"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
			<li><a href="?m=v_blog_post"><span class="glyphicon glyphicon-stats"></span> Informasi</a></li> 
            <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            <?php else:?>
            <li><a href="?m=hitung_hasil"><span class="glyphicon glyphicon-star"></span> Jadwal</a></li>
            <li><a href="?m=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            <?php endif?>                     
          </ul>          
        </div>
    </nav>
    <div class="container">    
    <?php
        if(!in_array($mod, array('login', 'home', '', 'hitung_hasil')) && !$_SESSION['login'])
            $mod='login';
        if(file_exists($mod.'.php'))
            include $mod.'.php';
        else
            include 'home.php';
    ?>
    </div>
    <footer class="footer bg-primary">
      <div class="container">
        <p>Copyright &copy; Suci puji </p>
      </div>
    </footer>
</html>