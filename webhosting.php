
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

	// Oturum Kontrolü
	
		if($_SESSION['login']!= "OK"){
			
					echo "
		<script>    
          sweetAlert({
                title:'Hata!',
                text: 'Bu sayfayı görebilmek için giriş yapmış olmanız gerekmektedir.',
                type:'warning',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'anasayfa';
			
          });</script>";
		  return;
		}

?>

<?
		$u_email = $_SESSION['email'];
		$u_password = $_SESSION['password'];
		
		$veri = $sql->prepare("SELECT * FROM users Where email=? AND password=?");
		$veri->execute(array($u_email,$u_password));
		
		$user_info = $veri->fetch(PDO::FETCH_ASSOC);
		
		$user_id = $user_info['id'];
		$name_surname = $user_info['namesurname'];
		$email = $user_info['email'];
		
		
		$host = $sql->prepare("SELECT * FROM hostings WHERE whoisthehost = ?");
		$host->execute(array($user_id));
		
		$host_info = $host->fetch(PDO::FETCH_ASSOC);
		
		$hostpleskyol = $host_info['pleskyol'];
		$hostdomain = $host_info['domain'];
		$hostpleskuser = $host_info['pleskuser'];
		$hostpleskpass = $host_info['pleskpass'];
		
		$hostftpuser = $host_info['ftpuser'];
		$hostftppass = $host_info['ftppass'];
		
	


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


<?

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	
require_once("api/PleskApi/examples/SplClassLoader.php");
$classLoader = new SplClassLoader('pmill\Plesk', 'api/PleskApi/src');
$classLoader->register();

$config = array(
    'host'=>'plesk.injectshell.com',
    'username'=>'root',
    'password'=>'vm1234ubuntu',
);



	if(isset($_POST['createhost'])){
		
			$ad_soyad = $_POST['adsoyad'];
			$pleskuser = $_POST['pleskuser'];
			$pleskpass = $_POST['pleskpass'];
			
			$domain = $_POST['domain'];
			$ftpuser = $_POST['ftpuser'];
			$ftppass = $_POST['ftppass'];
			
			
		
	$pleskbilgileri = array(
	'contact_name'=>$ad_soyad,
	'username'=>$pleskuser,
	'password'=>$pleskpass,
	);
	



	$request = new \pmill\Plesk\CreateClient($config, $pleskbilgileri);
	$info = $request->process();
	
	if($request->id > 0){
		
		// Plesk Kullanıcısı Oluşturuldu -- < > -- 
		// FTP Domain Oluşturulucak
		
		$domainftp = array(
		'domain_name'=>$domain,
		'username'=>$ftpuser,
		'password'=>$ftppass,
		'ip_address'=>'185.242.160.143',
		'owner_id'=>$request->id,
		'service_plan_id'=>6,
	);
	
	$istek = new \pmill\Plesk\CreateSubscription($config, $domainftp);
	$info = $istek->process();
	
	$query = $sql->prepare("INSERT INTO hostings SET domain = ?, pleskuser = ?, pleskpass = ?,ftpuser = ?, ftppass = ?, whoisthehost = ?");
	$ekle = $query->execute(array($domain,$pleskuser,$pleskpass,$ftpuser,$ftppass,$user_id));
	
	if($ekle && $istek->id > 0){
	
	echo "
		<script>    
          sweetAlert({
                title:'Tebrikler!',
                text: 'Ücretsiz hostinginiz başarıyla oluşturuldu.',
                type:'success',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'webhosting-olustur';
			
          });</script>";
		
		
		
	}else{
		
	echo "
		<script>    
          sweetAlert({
                title:'Hata!',
                text: 'Doamin veya FTP bilgilerinizde hata mevcut lütfen tekrar deneyin.',
                type:'warning',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'webhosting-olustur';
			
          });</script>";
		
	}
			
	}else{
		
	echo "
		<script>    
          sweetAlert({
                title:'Hata!',
                text: 'Plesk panel bilgilerinizde hata mevcut lütfen tekrar deneyin',
                type:'warning',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'webhosting-olustur';
			
          });</script>";
		
	}

	}


	
?>


<?
if($host->rowCount() < 1){
?>

<div class="card mb-3">
		<h5 class="card-header" ><font size="3"> Hoş Geldin : <? print $name_surname; ?> || Ücretsiz Web Hosting Oluştur</font></h5>
	<div class="card-body">
	<form action="webhosting-olustur" method="POST">
		  
		  
		  		<center>
		<hr>
		Plesk Panel Bilgileri
		<hr>
		</center>
		
		  		<div class="form-group">
			<label for="exampleInputEmail1">Ad-Soyad</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="adsoyad" aria-describedby="emailHelp" value="<? echo $name_surname; ?>" required autocomplete="off" readonly>
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Kullanıcı Adı</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="pleskuser" aria-describedby="emailHelp"  required autocomplete="off" >
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Parola</label>
			<input type="password" class="form-control" id="exampleInputEmail1" name="pleskpass" aria-describedby="emailHelp"  required autocomplete="off">
		</div>

		<br>
		<br>
		<br>
		
		
		<center>
		<hr>
		FTP / Domain Bilgileri
		<hr>
		</center>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Domain Başında <code>www</code> veya <code>http</code> olmadan yazın</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="domain" aria-describedby="emailHelp" value="" placeholder="domaininiz.com" required autocomplete="off" >
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1">FTP Kullanıcı Adınız</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="ftpuser" aria-describedby="emailHelp" value="" placeholder="" required autocomplete="off" >
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1">FTP Parolanız</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="ftppass" aria-describedby="emailHelp" value="" placeholder="" required autocomplete="off" >
		</div>
		
		<input type="submit"  required class="btn btn-primary" name="createhost" value="Hosting Oluştur" />
		  
	</form>
	</div>
</div>
<?}else{?>


<hr>
<center>Host Bilgileri</center>
<hr>

<table class="table table-dark" style="font-family:Exo,Monospace">
	
  <tbody>
      <tr>
      <td >Plesk Giriş Link : </td>
      <td><a href="<?print $hostpleskyol;?>" target="_blank"><? print $hostpleskyol; ?></a></td>
    </tr>
	
	
    <tr>
      <td >Domain : </td>
      <td><? print $hostdomain; ?></td>
    </tr>
	
    <tr>
      <td>Plesk Kullanıcı Adı :</td>
      <td><? print $hostpleskuser; ?></td>
 
    </tr>
	
	    <tr>
      <td>Plesk Parola :</td>
      <td><? print $hostpleskpass; ?></td>
 
    </tr>
	
		    <tr>
      <td>FTP Kullanıcı Adı :</td>
      <td><? print $hostpleskpass; ?></td>
 
    </tr>
	
	<tr>
      <td>FTP Parola :</td>
      <td><? print $hostpleskpass; ?></td>
 
    </tr>
	
		<tr>
      <td>Nameserverlar :</td>
      <td >ns1.injectshell.com || ns2.injectshell.com</td>
    </tr>
	
	<tr>
	<td>Alternatif Nameserverlar :</td>
	<td>ns1.injectshell.xyz || ns2.injectshell.xyz</td>
	
	</tr>

  </tbody>
</table>

<?}?>
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
