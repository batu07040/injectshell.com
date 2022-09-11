<?php

require_once("SplClassLoader.php");
$classLoader = new SplClassLoader('pmill\Plesk', '../../src');
$classLoader->register();

$config = array(
    'host'=>'plesk.injectshell.com',
    'username'=>'root',
    'password'=>'vm1234ubuntu',
);
