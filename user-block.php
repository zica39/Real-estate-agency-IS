<?php
	include './sql_driver.php';
	include './tools.php';
	include './global.php';
	
	if(!isset($_GET['id']))die('Error id does not exist...');
	
	if(!isAdmin())header('Location:./index.php');
	
	mysqli_query($db_conn,"BEGIN");
	$korisnik_id = $_GET['id'];
	$rez = mysqli_query($db_conn,"DELETE FROM nekretnina WHERE korisnik_id = $korisnik_id");
	
	if($rez){
		
		$rez1 = mysqli_query($db_conn,"DELETE FROM korisnik WHERE id = $korisnik_id");
		if($rez1){
		     mysqli_query($db_conn,"COMMIT");
			 header("Location:dashboard/korisnici.php?msg=Uspjesno brisanje korisnika");
		}else{
			mysqli_query($db_conn,"ROLLBACK");
			die('Greska prilikom brisanja korisnika');	
		}
		
	}else{
		mysqli_query($db_conn,"ROLLBACK");
		die('Greska prilikom brisanja nekretnina korisnika');	
	}
	
?>