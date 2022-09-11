<?
	
	session_start();
	ob_start();
	include("sql/db_connection.php");	#MySQL Connection
	


?>


<!doctype html>
<html lang="tr">
<head>
<?	include("pages/head.php"); ?>
<title>İnjectshell Ücretsiz Hizmet Platformu - Kayıt Ol</title>
<meta name="keywords" content="injectshell kayıt ol,kayıt ol,injectshell register,ish kayıt ol" />

</head>
<body>

<?

	session_destroy();
	setcookie ("email", "", time() - 3600);
	setcookie ("password", "", time() - 3600);
echo "	<script>    
          sweetAlert({
                title:'Tebrikler!',
                text: 'Tebrikler. Çıkış yapıldı.',
                type:'success',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'anasayfa';
			
          });</script>";
	return;
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
