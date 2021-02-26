<?php
	include './sql_driver.php';
	include './tools.php';
	include './global.php';
	
	if(!isAdmin())header('Location:./index.php');
	
	$db_name = unserialize(file_get_contents('config.conf'))['db_name'];
	unlink('config.conf');
	unlink('setup/config.conf');
	
	array_map('unlink', glob("img/users/*.*"));
	rmdir('img/users');
	mkdir('img/users');
	//logout();
	
	if(mysqli_query($db_conn,"DROP DATABASE $db_name")){
		header('Location:setup/index.php');	
	}else{
		die('Error to reset system');
	}
?>