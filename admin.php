<?

session_start();
ob_start();

include("sql/db_connection.php");
include("class.func.php");
			
if($admin_mi != 1){
			header("refresh:0; index.php");
			return;
}
		
		
		
		
		
		
		
		
		
		
?>


<!doctype html>
<html lang="tr">
<head>
<?	include("pages/head.php"); ?>

</head>
<body>


<?
if(isset($_POST['konu_ac'])){
	
	$konu_baslik = htmlspecialchars($_POST['konubasligi']);
	$konu_kisayazi = htmlspecialchars($_POST['konukisayazi']);
	$konu_icerik = htmlspecialchars($_POST['konuicerigi']);
	$konu_keywords = htmlspecialchars($_POST['konukeywords']);
	$konu_kategori = htmlspecialchars($_POST['kategori']);
	
	$kaynak = $_FILES["konuresim"]["tmp_name"]; // tempdeki adı
	$ad =  rand(1,9999999999);
	$tip = $_FILES["konuresim"]["type"];
	$boyut = $_FILES["konuresim"]["size"]; // boyutu
	$dizin = "img/topic_img";
	$kaydet = move_uploaded_file($kaynak,$dizin."/"."$ad"); // resmimizi klasöre kayıt 
	$konu_resim = "$dizin/$ad";

	if(!isset($konu_baslik,$konu_kisayazi,$konu_icerik,$konu_keywords,$konu_kategori)){
		
		
	echo "<script type='text/javascript'>alert('Tüm alanları doldurun.')</script>";
	header("refresh:0; url=admin.php");
	return;
		
		
	}
	
	$konuekle = $sql->prepare("INSERT INTO topics SET title=?, short_content=?, content=?, author=?, keywords=?, image=?, category_id=?");
	$konuekle->execute(array($konu_baslik,$konu_kisayazi,$konu_icerik,"Batu07040",$konu_keywords,$konu_resim,$konu_kategori));
	
	if($konuekle){
	echo "<script type='text/javascript'>alert('Konu paylaşıldı.')</script>";
	header("refresh:0; url=admin.php");
	return;
	}
	
}
?>

<?

if(isset($_POST['script_yukle'])){


	$script_aciklama = htmlspecialchars($_POST['script-desc']);
	
	
	$script_kaynak = $_FILES['script-file']['tmp_name'];
	$sc_ad = $_POST['script-name'];
	$script_dizin = "../dll.injectshell.com/src";
	$script_kaydet = move_uploaded_file($script_kaynak,$script_dizin."/"."$sc_ad");
	$script_link = "http://dll.injectshell.com/src/$sc_ad";
	
	if(!isset($script_aciklama,$sc_ad,$script_kaynak)){
			
	echo "<script type='text/javascript'>alert('Tüm alanları doldurun.')</script>";
	header("refresh:0; url=admin.php");
	return;
	
	}
	
	$scriptekle = $sql->prepare("INSERT INTO scripts SET script_name=?, script_description=?, script_link=?");
	$scriptekle->execute(array($sc_ad,$script_aciklama,$script_link));
	if($scriptekle){
	echo "<script type='text/javascript'>alert('Script paylaşıldı.')</script>";
	header("refresh:0; url=admin.php");
	return;
	}
	
}



		
?>




<!-- Navbar !-->
<div class="pos-f-t mb-3">
  <div class="collapse" id="navbarToggleExternalContent">
    <div class="bg-dark p-4">
      <h5 class="text-white h4">ISH Version 1.1.0 Admin Kontrol Paneli</h5>
      <span class="text-muted">Developer: Batu07040</span>
    </div>
  </div>
  <nav class="navbar navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  </nav>
</div>
<!-- Navbar !-->



<div class="container"><!-- Container !-->


  <div class="row mb-3">
  
    <div class="col-sm-5  offset-sm-2 offset-md-0 col-md-3 mb-3">
          <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Kullanıcı Listesi</a>
      <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Konu Gönder</a>
      <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Konu / Kategori Yönetimi</a>
      <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Script Yükle</a>
    </div>
    </div>
	
	
    <div class="col">


	 
	<div class="card">
	<div class="card-body">
		<div class="tab-content" id="nav-tabContent">
		  <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
		  

		  
		  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Ad Soyad</th>
      <th scope="col">E-Mail</th>
      <th scope="col">İşlem</th>
    </tr>
  </thead>
  <tbody>
  		<?
		$users = $sql->query("SELECT * FROM users");
		if($users->rowCount()){
			foreach($users as $userrows){
		
		?>
    <tr>
      <th scope="row"><?print $userrows['id'];?></th>
      <td><?print $userrows['namesurname'];?></td>
      <td><?print $userrows['email'];?></td>
      <td><a href="" data-toggle="modal" data-target="#user_edit">Düzenle</a></td>
    </tr>
		<?}}?>
  </tbody>
</table>
</div>
		  
		  <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
		  
		  <form  enctype="multipart/form-data" method="POST" action="admin">
		  
		  <div class="form-group">
			<label for="exampleInputEmail1">Konu Başlığı</label>
			<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Konu başlığı girin" name="konubasligi" required >
		  </div>
		  
		  <div class="form-group">
			<label for="exampleInputPassword1">Konu Kısa Yazı</label>
			<input type="text" class="form-control" name="konukisayazi" id="exampleInputPassword1" placeholder="Konu kısa yazısı" required>
		  </div>
		  
		  		  
		  <div class="form-group">
			<label for="exampleInputPassword1">Konu Keywords</label>
			<input type="text" class="form-control" name="konukeywords" id="exampleInputPassword1" placeholder="Konu anahtar kelimeleri" required>
		  </div>
		  
		  <div class="form-group">
		  		<label for="exampleInputPassword1">Konu Kategori</label>
		  <select class="form-control" name="kategori">
		  <?
		 	$getcategory = $sql->query("SELECT * FROM topics_category", PDO::FETCH_ASSOC);

			if($getcategory->rowCount()){
			foreach($getcategory as $category_row){
		
	
		  ?>
		  <option value="<?print $category_row['id'];?>"><?print $category_row['category_name'];?></option>
		  
	<?}}?>
		  
		  </select>
		  </div>
		  
			<div class="form-group">
			<label for="exampleInputPassword1">Konu Resimi</label>
			<input class="form-control" style="height:15%;" type="file" name="konuresim" required>
			</div>
		  
		  <div class="form-group" >
		  <label for="exampleInputPassword1">Konu İçeriği</label>
		  <textarea required name="konuicerigi" style="width:100%; height:360px;"></textarea>
		  </div>
		  

		  <input type="submit" name="konu_ac" class="btn btn-primary" value="Oluştur" required />
		</form>
		  
		  
		  </div>
		  
		  
		  
	<div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
			
	<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">#</th>
      <th scope="col">Başlık</th>
      <th scope="col">Kısa İçerk</th>
      <th scope="col">Kategori</th>

    </tr>
  </thead>
  <tbody>
  		<?
		$konular = $sql->query("SELECT * FROM topics");
		if($konular->rowCount()){
		foreach($konular as $konurows){
		
		$kate_id = $konurows['category_id'];
		
		$konukategori = $sql->prepare("SELECT * FROM topics_category WHERE id=?");
		$konukategori->execute(array($kate_id));
		$kategori_cek = $konukategori->fetch(PDO::FETCH_ASSOC);
		
	
		
		?>
    <tr>
	 <th scope="row"><?print $konurows['id'];?></th>
      <td ><img src="<?print $konurows['image'];?>" width="64" height="64"></td>
     
      <td><?print $konurows['title'];?></td>
      <td><?print $konurows['short_content'];?></td>
      <td><?print $kategori_cek['category_name'];?></td>
   </tr>
		<?}}?>
  </tbody>
</table>
			
		  </div>
		  
		  
		  
		  <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
		  
		  
		<form  enctype="multipart/form-data" method="POST" action="admin">
		  
		  <div class="form-group">
			<label for="exampleInputEmail1">Script Adı</label>
			<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Script Adını Girin" name="script-name" required >
		  </div>
		  
		  <div class="form-group">
			<label for="exampleInputPassword1">Script Açıklaması</label>
			<input type="text" class="form-control" name="script-desc" id="exampleInputPassword1" placeholder="Script Açıklaması" required>
		  </div>

		  
			<div class="form-group">
			<label for="exampleInputPassword1">Script Dosyası Yükleyin</label>
			<input class="form-control" style="height:15%;" type="file" name="script-file" required>
			</div>
		  
		  

		  <input type="submit" name="script_yukle" class="btn btn-primary" value="Script Yükle" required />
		</form>
		  
		  
		  
		  
		  </div>
		  
		  
		</div>
	</div>
	</div>
	
  </div>
  

  
</div>

</div><!-- Container !-->

		
<!-- Footer -->
<? include("pages/footer.php"); ?>
<!-- Footer -->


    <!-- Javascript Bootstrap <4.0> !-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  </body>
</html>
