<?
	
	session_start();
	ob_start();
	include("sql/db_connection.php");	#MySQL Connection
	


?>

<!doctype html>
<html lang="tr">
<head>
<title>İnjectshell Ücretsiz Hizmet Platformu - Linux Scriptleri</title>
<meta name="keywords" content="linux scriptleri,saldırı scripti,müzik botu scripti,linux scripts,putty scriptleri,centos saldırı scripti,ubuntu saldırı scripti" />

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
			

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Script Adı</th>
      <th scope="col">Script Açıklaması</th>
      <th scope="col">Script Linki</th>
    </tr>
  </thead>
  <tbody>
  
	<?
	
	$scripts = $sql->query("SELECT * FROM scripts");
	if($scripts->rowCount()){
			foreach($scripts as $scriptrows){
	?>
    <tr>
      <td><? print $scriptrows['script_name']; ?></td>
      <td><? print $scriptrows['script_description']; ?></td>
      <td><a href="<?print $scriptrows['script_link'];?>" target="_blank"><? print $scriptrows['script_link']; ?></a></td>
    </tr>
	<?}}?>
	
	
  </tbody>
</table>

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
