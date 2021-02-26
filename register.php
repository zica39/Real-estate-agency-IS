<?php

	include './sql_driver.php';
	include './tools.php';
	include './global.php';
	
	if($user)header('Location:./index.php');
	
	$error = '';
	$errorArr = [];
	$msg = '';
	
if(isset($_POST['submit'])){
	
	$ime = isset($_POST['name'])?$_POST['name']:false;
	$email = isset($_POST['email'])?$_POST['email']:false;
	$password = isset($_POST['password'])?$_POST['password']:false;
	$confirm_password = isset($_POST['confirm-password'])?$_POST['confirm-password']:false;
	
	if($ime){
		$count = mysqli_num_rows(mysqli_query($db_conn,"SELECT * FROM korisnik WHERE ime = '$ime'"));
		if($count){
			$error = 'Korisnicko ime vec postoji';
			$errorArr[] = 'name';
		}
		if(!nameValidaiton($email)){
			$error = 'Neispravan format korisnickog imena';
			$errorArr[] = 'name';
		}
	}else{
		$error = 'Morate unijeti korisnicko ime';
		$errorArr[] = 'name';
	}
	
	if($email){
		$count = mysqli_num_rows(mysqli_query($db_conn,"SELECT * FROM korisnik WHERE email = '$email'"));
		if($count){
			$error = 'Email vec postoji';
			$errorArr[] = 'email';
		}
		if(!emailValidation($email)){
			$error = 'Neispravan format email adresse';
			$errorArr[] = 'email';
		}
	}else{
		$error = 'Morate unijeti email adresu';
		$errorArr[] = 'email';
	}
	
	if($password){
		if($password != $confirm_password){
			$error = 'Lozinke se ne podudaraju';
			$errorArr[] = 'password';
		}
		if(!passwordValidation($email)){
			$error = 'Lozinka je preslaba';
			$errorArr[] = 'password';
		}
	}else{
		$error = 'Morate unijeti lozinku';
		$errorArr[] = 'password';
	}
	
	if($error == ''){
		$password = md5($password);
		$rez = mysqli_query($db_conn,"INSERT INTO korisnik (ime,email,password,aktiviran) VALUES('$ime','$email','$password',true)");
		
		if($rez)$msg = 'Uspjesna registracija';
		else $error = 'Greska pri upisu podataka';	
	
	}	
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Registracija</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    
    
    <!-- Font awesome -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">   
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="css/slick.css">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="css/nouislider.css">
    <!-- Fancybox slider -->
    <link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" media="screen" /> 
    <!-- Theme color -->
    <link id="switcher" href="css/theme-color/default-theme.css" rel="stylesheet">     

    <!-- Main style sheet -->
    <link href="css/style.css" rel="stylesheet">    

   
    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>    
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  

  </head>
  <body>   
  <section id="aa-signin">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-signin-area">
            <div class="aa-signin-form">
              <div class="aa-signin-form-title">
                <a class="aa-property-home" href="index.php"><?=$config['naziv']?></a>
                <h4>Registracija</h4>
				<h5><?=$msg?$msg:''?> <?=$error?$error:''?></h5>
              </div>
              <form <?=$msg?'hidden':''?> method = 'post' class="contactform">                                                 
                <div class="aa-single-field">
                  <label for="name">Korisnicko ime <span class="required">*</span></label>
                  <input type="text" required="required" aria-required="true" value="<?=isset($_POST['name'])?$_POST['name']:'';?>" name="name">
                </div>
                <div class="aa-single-field">
                  <label for="email">Email <span class="required">*</span></label>
                  <input type="email" required="required" aria-required="true" value="<?=isset($_POST['email'])?$_POST['email']:'';?>" name="email">
                </div>
                <div class="aa-single-field">
                  <label for="password">Lozinka <span class="required">*</span></label>
                  <input type="password" name="password"> 
                </div>
                <div class="aa-single-field">
                  <label for="confirm-password">Potvrda lozinke <span class="required">*</span></label>
                  <input type="password" name="confirm-password"> 
                </div>
                <div class="aa-single-submit">
                  <input type="submit" value="Kreiraj nalog" name="submit">                    
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> 


  <!-- jQuery library -->
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
  <script src="js/jquery.min.js"></script>   
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.js"></script>   
  <!-- slick slider -->
  <script type="text/javascript" src="js/slick.js"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="js/nouislider.js"></script>
   <!-- mixit slider -->
  <script type="text/javascript" src="js/jquery.mixitup.js"></script>
  <!-- Add fancyBox -->        
  <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
  <!-- Custom js -->
  <script src="js/custom.js"></script> 
  
  </body>
</html>