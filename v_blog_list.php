<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css'?>">
</head>
<body>
	<div class="container">
		<?php
			function limit_words($string, $word_limit){
                $words = explode(" ",$string);
                return implode(" ",array_splice($words,0,$word_limit));
            }
			foreach ($data->result() as $row) :
		?>
		<div class="col-md-8 col-md-offset-2">
			<h3><?php echo $row->post_judul;?></h3><hr/>
			<p><img src="<?php echo base_url().'assets/images/'.$row->post_image;?>" width="100px" height="100px" style="float:left; margin-right: 8px;">
			<?php echo limit_words($row->post_isi,100);?><a href="<?php echo base_url().'artikel/'.$row->post_slug;?>"> <strong>Selengkapnya ></strong></a>
		</div>
		<?php endforeach;?>
	</div>

	<script src="<?php echo base_url().'assets/jquery/jquery-2.2.3.min.js'?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js'?>"></script>
</body>
</html>