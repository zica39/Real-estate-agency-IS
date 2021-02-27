<?php

if(file_exists('config.conf')){
	$db = unserialize(file_get_contents('config.conf'));
}else{
	//die('Sistem is not installed');
	header('Location:setup/index.php');
}

 $db_conn = mysqli_connect($db['db_host'],$db['username'],$db['password'],$db['db_name']);
 if(!$db_conn){
	die('Problem sa konekcijom sa bazom podataka...');
 }
?>
