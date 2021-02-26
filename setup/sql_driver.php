<?php
define('config_file' , 'config.conf');

if(file_exists(config_file)){
	$db = unserialize(file_get_contents(config_file));
}else{
	die('Sistem is not installed');
}

 $db_conn = mysqli_connect($db['db_host'],$db['username'],$db['password'],$db['db_name']);
 if(!$db_conn){
	die('Problem sa konekcijom sa bazom podataka...');
 }
?>