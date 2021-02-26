<?php
	include './sql_driver.php';
	include './tools.php';
	
	if(!isset($_GET['id']))die('Error id does not exist...');
	
	$user = getUser();
	if(!$user)header('Location:./index.php');
	
	$korisnik_id = $user['id'];
	$id = $_GET['id'];
	
	removePhotos($id,$korisnik_id);
	$del = mysqli_query($db_conn,"DELETE FROM nekretnina WHERE korisnik_id = $korisnik_id AND id = $id");
	
	if($del){
		header("Location:./my_properties.php");	
	}else{
		die('Error whit db');	
	}
?>