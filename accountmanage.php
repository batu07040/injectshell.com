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
		$passwd = $user_info['password'];
		

?>

<?

		if(isset($_POST['updatebutton'])){
			
			$new_password = md5($_POST['new_pw']);
			$last_password = md5($_POST['last_pw']);
			
			
			if($passwd == $last_password){

			$update = $sql->prepare("UPDATE users SET password = ? WHERE email=? AND password=?");
			$update->execute(array($new_password,$email,$last_password));
			$_SESSION["password"] = "$new_password";
			
								echo "
		<script>    
          sweetAlert({
                title:'Tebrikler!',
                text: 'Şifreniz başarılı bir şekilde güncellenmiştir.',
                type:'success',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'hesap-yonetimi';
			
          });</script>";
		}else{
											echo "
		<script>    
          sweetAlert({
                title:'Hata!',
                text: 'Girmiş olduğunuz eski şifre geçersiz.',
                type:'warning',
				confirmButtonText: 'OK'
				
          },function(isConfirm){
            window.location.href = 'hesap-yonetimi';
			
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

	
<div class="card mb-3">
		<h5 class="card-header" ><font size="3"> Hoş Geldin : <? print $name_surname; ?></font></h5>
	<div class="card-body">
	<form action="hesap-yonetimi" method="POST">
		  
		  		<div class="form-group">
			<label for="exampleInputEmail1">Ad-Soyad</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="namesurname" aria-describedby="emailHelp" value="<? echo $name_surname; ?>" required autocomplete="off" readonly>
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1">E-Posta</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="<? echo $email; ?>" required autocomplete="off" readonly>
		</div>

		<center>
		<hr>
		Parola Değiştirme Bölümü
		<hr>
		</center>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Eski Parolanız</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="last_pw" aria-describedby="emailHelp" value="" required autocomplete="off" >
		</div>
		
		<div class="form-group">
			<label for="exampleInputEmail1">Yeni Parola</label>
			<input type="text" class="form-control" id="exampleInputEmail1" name="new_pw" aria-describedby="emailHelp" value="" required autocomplete="off" >
		</div>
		
		<input type="submit"  required class="btn btn-primary" name="updatebutton" value="Hesap Bilgilerimi Güncelle" />
		  
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
