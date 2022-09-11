<?
function GetIP(){
 if(getenv("HTTP_CLIENT_IP")) {
 $ip = getenv("HTTP_CLIENT_IP");
 } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
 $ip = getenv("HTTP_X_FORWARDED_FOR");
 if (strstr($ip, ',')) {
 $tmp = explode (',', $ip);
 $ip = trim($tmp[0]);
 }
 } else {
 $ip = getenv("REMOTE_ADDR");
 }
 return $ip;
}


$verimiz = GetIP();


if(!file_exists("ips/$verimiz")){
	touch("ips/$verimiz");	
}

?>
    <!-- Required meta tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="all" />
	<meta name="author" content="Batuhan Canik ~ Batu07040@DJPizza" />
	<meta name="description" content="Bu site ücretsiz hizmet sunmak için yapılmıştır. Tüm dünya hizmetlerimizden yararlanabilir.." />
	
	
	
    <!-- Bootstrap CSS -->
	<base href="https://injectshell.com" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="icon" href="favicon.ico" type="image/x-icon"/>
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
	
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
  

    <style>
    body{

      background:#f5f8fa;
      @media (min-width: 1200px) {.container
        max-width:1200px;
      }
    }
	
	a:link {text-decoration: none;}


    </style>