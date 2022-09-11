<?
	
	session_start();
	ob_start();
	include("sql/db_connection.php");	#MySQL Connection
	


?>

<!doctype html>
<html lang="tr">
<head>
<title>İnjectshell Ücretsiz Hizmet Platformu - İptables Kural Oluştur</title>
<meta name="keywords" content="iptables rule creator,iptables kural olustur,iptables rule create,online iptables rules,iptables kural oluştur,online iptables kuralı oluştur" />

<?	include("pages/head.php"); ?>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
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
			
			<div class="card mb-3"  ng-app="">
				  <h5 class="card-header">İptables Kural Oluştur</h5>
				<div class="card-body">
					<font face="Exo">
					
	<div class="form-group">
	<select class="form-control" name="iptablestype" ng-model="paketturu">
	<option value="" checked="ON">Paket Türünü Seçin</option>
	<option value="-A INPUT">Gelen Paketlere Kural Gir (INPUT)</option>
	<option value="-A FORWARD">Yönlenen Paketlere Kural Gir (FORWARD)</option>
	<option value="-A OUTPUT">Giden Paketlere Kural Gir (OUTPUT)</option>
	</select>
	</div>
	
	<div class="form-group">
	<select class="form-control" name="trafikturu" ng-model="trafikturu">
	<option value="" checked="ON">Trafik Protokolü Seçin</option>
	<option value="-p tcp">TCP</option>
	<option value="-p udp">UDP</option>
	</select>
	</div>
	
	<div class="form-group">
	<select class="form-control" name="porttype" ng-model="portturu">
	<option value="" checked="ON">Port Türü Seçin (Port Girilmeyecek ise Default)</option>
	<option value="--dport">Hedef Port {dport}</option>
	<option value="--sport">Kaynak Port {sport}</option>
	</select>
	</div>
	
	<div class="form-group">
	<input class="form-control" type="text" name="port" ng-model="port" placeholder="Port Girin veya Boş Bırakın">
	</div>
	
	<div class="form-group">
	<select class="form-control" name="ips" ng-model="iptype">
	<option value="" checked="ON">IP Türü Seçin (IP Girilmeyecek ise Default)</option>
	<option value="-s">IP Girilecek {Kaynak IP}</option>
	</select>
	</div>
  

	<div class="form-group">
	<input class="form-control" type="text" name="ips" ng-model="ipadress"  placeholder="IP Girin veya Boş Bırakın">
	</div>
	
	<div class="form-group">
	<select class="form-control" name="sze" ng-model="islem">
	<option value="" checked="ON">Yapılacak İşlemi Seçin</option>
	<option value="-j ACCEPT">İzin Ver (ACCEPT)</option>
	<option value="-j REJECT">Reddet (REJECT)</option>
	<option value="-j DROP">Düşür (DROP)</option>
	</select>
	</div>
	<br>
	
	<h3 align="center">Kural Çıktısı</h3>
	<hr>
	<code>
	  iptables <span ng-bind="paketturu"></span>  <span ng-bind="trafikturu"></span> <span ng-bind="portturu"></span> <span ng-bind="port"></span> <span ng-bind="iptype" ></span>  <span ng-bind="ipadress" ></span> <span ng-bind="islem" ></span>
	</code>
	<hr>
					
					</font>
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
