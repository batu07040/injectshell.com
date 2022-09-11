<?
	
	session_start();
	ob_start();
	include("sql/db_connection.php");	#MySQL Connection
	


?>

<!doctype html>
<html lang="tr">
<head>
<title>İnjectshell Ücretsiz Hizmet Platformu - Shell Script Şifreleme</title>
<meta name="keywords" content="shell script şifrele,script şifreleme,bash script şifreleme,sh script sifreleme,online script şifreleme,bash compiler,bash encrypter" />

<?	include("pages/head.php"); ?>
</head>
<body>

<?
		
		set_include_path(get_include_path() . PATH_SEPARATOR . 'api/phpseclib');
		include('Net/SSH2.php');
		error_reporting(1);
		
		$shell_server = new Net_SSH2('54.38.29.12');
		
		if(!$shell_server->login("root","atlas.com")){
		exit("Sifreleme sunucusuna baglanilamadi.");
		}
		
		if(isset($_POST['shell_sifrele'])){
			
		$rand = rand(599999,9999999999999);
		$dizin = '../dll.injectshell.com/';
		$yuklenecek_dosya = $dizin . basename("$rand.sh");
		if (move_uploaded_file($_FILES['shelldosya']['tmp_name'], $yuklenecek_dosya))
		{
		$shell_server->exec("cd /var/www/dll.injectshell.com && ./multixscript -r -f $rand.sh");	
		if(file_exists("/var/www/dll.injectshell.com/$rand.sh.x") && file_exists("/var/www/dll.injectshell.com/$rand.sh.x")){
		
		
		echo "
		<script>    
          sweetAlert({
                title:'Şifreleme başarılı!',
                text: 'Shell scriptiniz başarılı bir şekilde şifrelendi.',
                type:'success',
				confirmButtonText: 'Şifreli Dosyayı İndir'
				
          },function(isConfirm){
            window.location.href = 'shell-script-sifreleme';
			window.open('http://dll.injectshell.com/$rand.sh.x','_blank');
			window.open('http://dll.injectshell.com/$rand.sh.x.c','_blank');
			
          });</script>";
		  
		}else{

					echo "
		<script>    
          sweetAlert({
                title:'Hata!',
                text: 'Hata! Şifreleme işlemi başarısız. Yüklediğiniz dosya geçersiz olabilir.',
                type:'warning'
          },function(isConfirm){
                window.location.href = 'shell-script-sifreleme';
          });</script>";
		 
		}
		
		}
		}
		


?>



<!-- Navbar !-->
<? include("pages/navbar.php"); ?>
<!-- Navbar !-->



<div class="container"><!-- Container !-->
	<div class="row mb-3"><!-- Row !-->

		
<div class="col-md-9 offset-md-0">

		<!-- Slider !-->
		<? include("pages/slider.php"); ?>
		<!-- Slider !-->
			
			<div class="card mb-3">
				  <h5 class="card-header">Şifreli Shell Scripti Oluştur</h5>
				<div class="card-body">
					<form name="shell_sifreleme_form" enctype="multipart/form-data" method="POST" action="shell-script-sifreleme">
						
						<div class="form-group">
							<label for="exampleInputPassword1">Şifrelenecek Dosya</label>
								<input class="form-control" style="height:15%;" type="file" name="shelldosya" required>
						</div>
						
							<input type="submit" name="shell_sifrele" class="btn btn-primary" Value="Şifrele" />
					</form>
				</div>
			</div>
		</div>
		
		
		<!-- Col Right !-->
		<?include("pages/col-right.php");?>
		<!-- Col Right !-->
		
		
	</div><!-- Row !-->
</div><!-- Container !-->

		
<!-- Footer -->
<? include("pages/footer.php"); ?>
<!-- Footer -->


    <!-- Javascript Bootstrap <4.0> !-->
<?include("pages/javascript.php");?>
	<!-- !-->
  </body>
</html>
