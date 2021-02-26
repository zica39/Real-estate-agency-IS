<?php
	include './sql_driver.php';
	include './tools.php';
	
	if(!isset($_GET['id']))die('Error id does not exist...');
	
	$user = getUser();
	if(!$user)header('Location:./index.php');
	
	$korisnik_id = $user['id'];
	$id = $_GET['id'];
	
	$del = mysqli_query($db_conn,"Update nekretnina SET status=1 WHERE korisnik_id = $korisnik_id AND id = $id");
	
	if($del){
		header("Location:./properties-detail.php?id=$id");	
	}else{
		die('Error whit db');	
	}
?>