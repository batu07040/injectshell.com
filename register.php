
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

if(isset($_POST['regbutton'])){
	
	$namesurname = htmlspecialchars($_POST['namesurname']);
	$password = htmlspecialchars(md5($_POST['password']));
	$repassword = htmlspecialchars(md5($_POST['repassword']));
	$email = htmlspecialchars($_POST['email']);
	
	if(!isset($namesurname,$password,$repassword,$email)){
	echo "
		<script>    
          sweetAlert({
                title:'Kayıt başarısız!',
                text: 'Tüm alanları doldurmanız gerekmektedir.',
                type:'warning',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'kayit-ol';
			
          });</script>";
		  return;
	}
	
	$email_check = $sql->prepare("SELECT * FROM users Where email=?");
	$email_check->execute(array($email));
	$check_email = $email_check->rowCount();
	
	if($check_email > 0){	
	echo "
		<script>    
          sweetAlert({
                title:'Kayıt başarısız!',
                text: 'Girilen e-posta adresi zaten sitemizde kayıtlı.',
                type:'warning',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'kayit-ol';
			
          });</script>";
		  return;
	}
	
	if($password != $repassword){
	echo "
		<script>    
          sweetAlert({
                title:'Kayıt başarısız!',
                text: 'Girilen parolalar eşleşmiyor.',
                type:'warning',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'kayit-ol';
			
          });</script>";
		  return;
	}
	
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
	echo "
		<script>    
          sweetAlert({
                title:'Kayıt başarısız!',
                text: 'Girilen e-posta adresi geçersiz.',
                type:'warning',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'kayit-ol';
			
          });</script>";
		  return;
	}
	
	$useradd = $sql->prepare("INSERT INTO users SET namesurname = ?, email = ?, password = ?");
	$adduser = $useradd->execute(array($namesurname, $email, $password));
	
	if ( $adduser ){
	echo "
		<script>    
          sweetAlert({
                title:'Kayıt başarılı!',
                text: 'Tebrikler sitemize başarılı bir şekilde kayıt oldunuz.',
                type:'success',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'giris-yap';
			
          });</script>";
		  return;
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

<?if(!$_SESSION['email']){?>	
<div class="card mb-3">
		<h5 class="card-header">Kayıt Ol</h5>
	<div class="card-body">
	<form action="kayit-ol" method="POST">
		  
		<div class="form-group">
			<label for="exampleInputEmail1">Ad & Soyad</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="namesurname" aria-describedby="emailHelp" placeholder="Ad Soyad" required autocomplete="off">
		</div>
		  
		<div class="form-group">
			<label for="exampleInputEmail1">E-Mail </label>
			<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="E-Mail" required autocomplete="off">
		</div>
		  
		<div class="form-group">
			<label for="exampleInputPassword1">Parola</label>
			<input type="password" maxlength="15" class="form-control" id="exampleInputPassword1" name="password" placeholder="Parola" required autocomplete="off">
		</div>
		  
		<div class="form-group">
			<label for="exampleInputPassword1">Parola Tekrar</label>
			<input type="password" maxlength="15" class="form-control" id="exampleInputPassword1" name="repassword" placeholder="Parola Tekrar" required autocomplete="off">
		</div>

		  <input type="submit"  required class="btn btn-primary" name="regbutton" value="Kayıt Ol" />
		  
	</form>
	</div>
</div>
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
