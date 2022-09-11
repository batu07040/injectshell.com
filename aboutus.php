<?
	
	session_start();
	ob_start();
	include("sql/db_connection.php");	#MySQL Connection
	


?>


<!doctype html>
<html lang="en">
<head>
<?	include("pages/head.php"); ?>
</head>
<body>



<!-- Navbar !-->
<? include("pages/navbar.php"); ?>
<!-- Navbar !-->





    <div class="container">

      <div class="row">


	<div class="col">
	

	
	<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Hakkımızda</h1>
    <code class="highlighter-rouge" align="justify">
	ISH Project 1.3.4 @§
	<br>
	<br>
	Sitemizde bulunan tüm içerikler kullanıcılarımıza ücretsiz olarak sunulmaktadır. İçeriklerden faydalanan kullanıcılar aynı zamanda tüm sorumlulukları kabullenmiş olur. Sitemiz üzerindeki hiçbir hizmet kötüye kullanılamaz ve kullanılması yasaktır.
	<br>
	<br>
	İletişim Bilgilerimiz:<br>
	Web Developer: http://fb.com/skytechbatu<br>
	Web Director: https://www.facebook.com/emin.yenturk.73 <br>
	Mail: admin@injectshell.com
	</code>
  </div>
</div>
	

</div>
		

		
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
