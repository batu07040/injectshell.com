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

				<div class="card-body">
				<center><code> Attack IP : 94.177.245.97 </code></center>
				<iframe src="http://dstat.live/94.177.245.97">
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
