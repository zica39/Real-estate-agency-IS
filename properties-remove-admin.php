<?php
	include './sql_driver.php';
	include './tools.php';
	include './global.php';
	
	if(!isset($_GET['id']))die('Error id does not exist...');
	
	if(!isAdmin())header('Location:./index.php');
	
	$id = $_GET['id'];
	$korisnik_id = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT korisnik_id FROM nekretnina WHERE id = $id"))['korisnik_id'];
	
	removePhotos($id,$korisnik_id);
	$del = mysqli_query($db_conn,"DELETE FROM nekretnina WHERE korisnik_id = $korisnik_id AND id = $id");
	
	if($del){
		header("Location:./my_properties.php");	
	}else{
		die('Error whit db');	
	}
?>