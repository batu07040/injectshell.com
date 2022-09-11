<?php

require_once("../SplClassLoader.php");
$classLoader = new SplClassLoader('pmill\Plesk', '../../src');
$classLoader->register();


$params = array(
	'contact_name'=>'asfgshdsgasd',
	'username'=>'asdasdsaf',
	'password'=>'asfasggsdhs!',
);


$request = new \pmill\Plesk\CreateClient($config, $params);