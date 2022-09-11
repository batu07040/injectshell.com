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
if(isset($_POST['loginbutton'])){
	
	
	
	$email_login = htmlspecialchars($_POST['email_login']);
	$password_login = htmlspecialchars(md5($_POST['password_login']));
	
	$user_check = $sql->prepare("SELECT * FROM users Where email=? AND password=?");
	$user_check->execute(array($email_login,$password_login));
	$check_user = $user_check->rowCount();
	
		if($check_user > 0){
			
			$_SESSION["login"] = "OK";
			$_SESSION["email"] = "$email_login";
			$_SESSION["password"] = "$password_login";
			
			setcookie("email",$email_login, '/', '.injectshell.com');
			setcookie("password",$password_login, '/', '.injectshell.com');

		echo "	<script>    
          sweetAlert({
                title:'Tebrikler!',
                text: 'Bilgiler doğrulandı. Hesabınıza başarıyla giriş yaptınız.',
                type:'success',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'anasayfa';
			
          });</script>";
		  
		}else{
		echo "	<script>    
          sweetAlert({
                title:'Hata!',
                text: 'Girdiğiniz bilgiler ile eşleşen bir kullanıcı bulunamamıştır.',
                type:'warning',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'giris-yap';
			
          });</script>";
		  
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

	<?if($_SESSION['login'] != "OK"){?>
<div class="card mb-3">
		<h5 class="card-header">Giriş Yap</h5>
	<div class="card-body">
	<form action="giris-yap" method="POST">
		  
		<div class="form-group">
			<label for="exampleInputEmail1">E-Posta</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="email_login" aria-describedby="emailHelp" placeholder="E-Posta Adresi" required autocomplete="off">
		</div>
		  
		<div class="form-group">
			<label for="exampleInputPassword1">Parola</label>
			<input type="password" maxlength="15" class="form-control" id="exampleInputPassword1" name="password_login" placeholder="Parola" required autocomplete="off">
		</div>
		
		<input type="submit"  required class="btn btn-primary" name="loginbutton" value="Giriş Yap" />
		  
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
