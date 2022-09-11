<?
	
	session_start();
	ob_start();
	include("sql/db_connection.php");	#MySQL Connection
	


?>


<!doctype html>
<html lang="tr">
<head>

<title>İnjectshell Ücretsiz Hizmet Platformu - Anasayfa</title>
<meta name="keywords" content="injectshell,ish,bedava müzikbotu,bedava audiobot,bedava sinusbot,ücretsiz instagram takipçi,instagram followers,shell script şifreleme,teamspeak3 proxy,ddos monitör" />

<?	include("pages/head.php"); ?>


</head>
<body>



<!-- Navbar !-->
<? include("pages/navbar.php"); ?>
<!-- Navbar !-->





    <div class="container">

      <div class="row">


	<div class="col-md-9 offset-md-0">
	
	<?include("pages/slider.php");?>

	
	<div class="card-group mb-3">
	
	<?

	$konucek = $sql->prepare("SELECT * FROM topics Order By id DESC LIMIT 3");
	$konucek->execute(array($cid));
	if($konucek->rowCount()){
	foreach($konucek as $cekkonu){
	?>
	
  <div class="card">
 
    <img class="card-img-top" width="328" height="119" src="<?print $cekkonu['image']; ?>" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title"><?print $cekkonu['title'];?></h5>
				  <a href="konular/<?=seo($cekkonu["title"]).'/'.$cekkonu["id"]?>"><button type="button" class="btn btn-sm btn-outline-secondary">Yazıyı Görüntüle</button></a>
    </div>
  </div>

  
  
	<?}}?>
	
	
	</div>
	
	
	  <div class="card mb-3">
 
    <div class="card-body">
	

 
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
