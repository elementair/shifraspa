<?php 

session_start();

require_once('extenciones/vendor/autoload.php');

require_once('app/facebookAuth.php');

$facebook = new Facebook\Facebook([
	'app_id' =>'1141521919328534',
	'app_secret' => '0ec113f098d47a910bd3e3161d8e85d5',
	'default_graph_version' => 'v3.2',

]);

$fbauth = new FacebookAuth($facebook); 


?>