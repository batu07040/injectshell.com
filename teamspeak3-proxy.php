<?
	
	session_start();
	ob_start();
	include("sql/db_connection.php");	#MySQL Connection
	


?>

<!doctype html>
<html lang="tr">
<head>
<title>İnjectshell Ücretsiz Hizmet Platformu - Teamspeak3 Proxy Oluştur</title>
<meta name="keywords" content="teamspeak3 proxy oluştur,bedava ts3 proxy,ts3proxy,free teamspeak3 proxy,teamspeak3,proxy,teamspeak3proxy,proxy teamspeak3,teamspeak3 for proxy" />

<?	include("pages/head.php"); ?>
</head>
<body>

<?
		
		set_include_path(get_include_path() . PATH_SEPARATOR . 'api/phpseclib');
		include('Net/SSH2.php');
		
		$proxy_server = new Net_SSH2('54.38.29.12');
		
		if(!$proxy_server->login("root","atlas.com")){
		exit("Proxy sunucusuna baglanilamadi.");
		}
		
		if(isset($_POST['proxyolustur'])){
			
		$ip = $_POST['proxyip'];
		$port = $_POST['proxyport'];
		$rand = rand(1000,60000);
		$proxy_server->exec("./proxy $rand $ip $port");


		echo "
		<script>    
          sweetAlert({
                title:'54.38.29.12:$rand',
                text: 'Tebrikler. Verdiğiniz adrese yönelik proxy yapılandırması kuruldu. Bilgileri üst kısımdan alabilirsiniz.',
                type:'success'
          },function(isConfirm){
                window.location.href = 'teamspeak3-proxy-olustur';
          });</script>";

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
				  <h5 class="card-header">Proxy Oluştur</h5>
				<div class="card-body">
					<form name="proxy_ac" action="teamspeak3-proxy-olustur" method="POST">
						<div class="form-group">
							<label for="exampleInputEmail1">IP </label>
							<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Proxy'in Yönlendirileceği IP" name="proxyip">
						</div>
						
						<div class="form-group">
							<label for="exampleInputPassword1">Port</label>
							<input type="text" class="form-control" id="exampleInputPassword1" placeholder="Proxy'in Yönlendirileceği Port" name="proxyport">
						</div>
							<input type="submit" name="proxyolustur" class="btn btn-primary" Value="Oluştur" />
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
