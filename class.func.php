<?
	
	
	#Kullanıcı admin kontrolü
	$eposta_x = $_SESSION['email'];
	$parola_x = $_SESSION['password'];
	$admin_mi = $sql->prepare("SELECT * FROM users WHERE email=? AND password=?");
	$admin_mi->execute(array($eposta_x,$parola_x));
	$veri_admin = $admin_mi->fetch(PDO::FETCH_ASSOC);
	$admin_mi = $veri_admin['this_admin'];
	
	
	
	

	
	
	
?>