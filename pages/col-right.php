	<div class="col">
		
<?if($_SESSION["login"] == "OK"){?>

		<div class="card mb-3">
		  <div class="card-header">
			<center><code class="highlighter-rouge text-dark">Hoşgeldin <? echo $_SESSION['email']; ?></code></center>
		  </div>
		  <div class="card-body">
			
			<?
			
			include("class.func.php");
			
			if($admin_mi == 1){
			?>
			<a href="admin.php"><button type="button" style="width:100%" class="btn btn-dark mb-3">Kontrol Paneli</button></a>
			<?}?>
			<a href="hesap-yonetimi"><button type="button" style="width:100%" class="btn btn-dark mb-3">Hesap Bilgileri</button></a>
			<a href="cikis"><button type="button" style="width:100%" class="btn btn-dark mb-3">Çıkış</button></a>

		  </div>
		  
		</div>
	
<?}else{?>
		<div class="card mb-3">
		  <div class="card-header">
			Kullanıcı Girişi
		  </div>
		  <div class="card-body">
		  <form method="POST" action="giris-yap">
			<input type="email" name="email_login" class="form-control mb-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="E-Posta Adresi" required>
			<input type="password" name="password_login" class="form-control mb-3" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" placeholder="Parola" required>
			<input type="submit" name="loginbutton" class="btn btn-primary mb-3" style="width:100%;" value="Giriş"/ >
			</form>
			<a href="kayit-ol" >Yeni bir hesap oluştur</a><br>
			<a href="#">Parola Sıfırla</a>
			
		  </div>

		  
		</div>
		
<?}?>
		<div class="card mb-3" align="center">
		<div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'tr', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
		</div>
		
			

		
		<div class="card mb-3">
	  <div class="card-header">
		Google Reklamları
	  </div>
	  
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Esnek Reklam -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-8846233503862198"
     data-ad-slot="8688440829"
     data-ad-format="auto"
     data-full-width-responsive="true"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
		
		</div>

        </div>