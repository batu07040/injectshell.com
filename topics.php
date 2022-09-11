<?
	
	session_start();
	ob_start();
	include("sql/db_connection.php");	#MySQL Connection
	
?>



<!doctype html>
<html lang="tr">
<head>
<?	include("pages/head.php"); ?>

	<?
	
		$read_id = $_GET['read'];
	$getread = $sql->prepare("SELECT * FROM topics WHERE id=?");
	$getread->execute(array($read_id));
	if($getread->rowCount()){
		foreach($getread as $getreadrow){
			$title = $getreadrow['title'];
			$keywords = $getreadrow['keywords'];
			$short_content = $getreadrow['short_content'];
			$img = $getreadrow['image'];
		}
	}
			
	?>
	
<title>İnjectshell Ücretsiz Hizmet Platformu - <? echo $title; ?></title>

<meta name="keywords" content="Konular,<? echo "$keywords"; ?> "/>
<meta name="description" content="<? echo "$short_content"; ?>" />
<link rel="image_src" href="<? echo $img; ?>" />
<link href="https://fonts.googleapis.com/css?family=Exo" rel="stylesheet">
<style>
li{
list-style-type:none;
}

.mavis{
	color:blue;
}

iframe{
	
	max-width:100%;
	min-width:100%;
}
</style>
</head>
<body>



<!-- Navbar !-->
<? include("pages/navbar.php"); ?>
<!-- Navbar !-->



	<div class="container">

	<div class="row mb-3">
	


	<div class="col-sm-5 offset-sm-2 col-md-3 offset-md-0">



	
		<div class="shadow p-3 bg-white rounded" >Kategoriler</div>
	<div class="card mb-3">
	
	<ul class="list-group">
		<?
	$getcategory = $sql->query("SELECT * FROM topics_category", PDO::FETCH_ASSOC);

	if($getcategory->rowCount()){
	foreach($getcategory as $category_row){
	$cate_id = $category_row['id'];
	$category_thread_num = $sql->prepare("SELECT * FROM topics WHERE category_id=? Order by id desc");
	$category_thread_num->execute(array($cate_id));
	?>
	 <a href="kategoriler/<?=seo($category_row["category_name"]).'/'.$category_row["id"]?>"><li class="list-group-item d-flex justify-content-between align-items-center">
		<?print $category_row['category_name'];?>
		<span class="badge badge-primary badge-pill"><?print $category_thread_num->rowCount(); ?></span>
	  </li></a>
	<?}}?>
	</ul>
</div>
		</div>

		
   
	<div class="col-sm-5 offset-sm-2 col-md-6 offset-md-0">



	<?if($_GET['read']==""){?>
	
	<?
	$ara = $_GET['ara'];
	if($ara == NULL){
	$cid = $_GET['category_id'];
	if($cid!=null){
	$gettopic = $sql->prepare("SELECT * FROM topics WHERE category_id=? Order by id desc");
	$gettopic->execute(array($cid));
	}else{
	$gettopic = $sql->prepare("SELECT * FROM topics Order by id desc");
	$gettopic->execute();
	}
	}else{
	$gettopic = $sql->prepare("SELECT * FROM topics WHERE title LIKE :ara or short_content LIKE :ara Order by id desc");
	$gettopic->bindValue(':ara','%'.$ara.'%'); 
	$gettopic->execute();
	}
	
	if($gettopic->rowCount()){
	foreach($gettopic as $row){
	

	?>
	
	<div class="card mb-3">
		<img class="card-img-top" src="<?print $row['image'];?>" width="100" height="180" alt="Konu Resmi">
			<div class="card-body">
				<h5 class="card-title"><a href="konular/<?=seo($row["title"]).'/'.$row["id"]?>"><?print $row['title'];?></a></h5>
				<p class="card-text" maxlength="120"><?print $row['short_content'];?></p>
				  <a href="konular/<?=seo($row["title"]).'/'.$row["id"]?>"><button type="button" class="btn btn-sm btn-outline-secondary">Yazıyı Görüntüle</button></a>
	
 
			</div>
	</div>

	<?}}?>



	<?
	}
	else{
		

	?>
	
<div class="card mb-3">
 <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail" alt="Konu Resmi" style="height: 225px; width: 100%; display: block;" src="<?print $getreadrow['image'];?>" data-holder-rendered="true">
	<div class="card-body">
		<div class="media">
			<font face="Exo">
				<div class="media-body">
					<h5 class="mt-0"><?print $getreadrow['title'];?></h5>
					<?
					$yazi = htmlspecialchars_decode($getreadrow['content']);
					$lines = explode("\n", $yazi); // or use PHP PHP_EOL constant
					if ( !empty($lines) ) {
	
					  foreach ( $lines as $line ) {
						echo ''. trim( $line ) .'<br />';
					  }
					}

					?>
				</div>
			</font>
		</div>
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



<? include("pages/javascript.php");?>
 </body>
</html>
