<div class="page-header">
    <h1>Tambah Berita</h1>
	
<div class="row">
    <div class="col-md-6">
        <form action="?">
            <input type="hidden" name="m" value="v_blog_post"/>
	            <input type="text" name="judul" class="form-control" placeholder="Judul" required/><br/>
	            <textarea  id="editor1" name="isi" class="form-control" required></textarea><br/>
	            <input type="file" name="filefoto" required><br>
	            <button class="btn btn-success" type="submit">POST</button>
				
            </form>
	<script src="assets/jquery/jquery-2.2.3.min.js'?>"></script>
    <script src="assets/js/bootstrap.js"></script> 
	<script src="assets/ckeditor/ckeditor.js?"></script>	
	<script type="text/javascript">
	  $(function () {
	  	// Fungsi untuk mengganti textarea dengan ckeditor style
	      CKEDITOR.replace( 'editor1' ,{
              extraPlugins : 'syntaxhighlight',        
              toolbar: [
                     ['Source'] ,
                     ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','Image'] ,
                   ]              
            });

	  });
	</script>
	</div>
	</div>
	</div>
	