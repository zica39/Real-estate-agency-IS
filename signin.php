<?php
	include './sql_driver.php';
	include './tools.php';
	include './global.php';
	
	if(isset($_GET['logout']))logout();
	if($user)header('Location:./index.php');
	
	$error = '';
	$errorArr = [];
	
	
if(isset($_POST['submit'])){
	
	$email = isset($_POST['email'])?$_POST['email']:false;
	$password = isset($_POST['password'])?$_POST['password']:false;
	
	if($email){
		
		if($password){
			
			$password = md5($password);
			$res = mysqli_query($db_conn,"SELECT id,ime FROM korisnik WHERE email = '$email' AND password = '$password'");
			
			$assoc = mysqli_fetch_assoc($res);
			
			if($assoc){
				$id = $assoc['id'];
				$name = $assoc['ime'];
			
				$_SESSION['user'] = ['id' => $id, 'username' => $name ];
				if(isset($_POST['remember']))setcookie("user", serialize(['id' => $id, 'username' => $name ]), (time()+(3600*24*30))); // Expiring after 2 hours

				header('Location: ./index.php');
			}else{
				$error = 'Email ili lozinka neispravni';
			}
		}else{
			$error = 'Niste unijeli lozinku';
			$errorArr[] = 'name';
			
		}
		
	}else{
		
		$error = 'Niste unijeli email adresu';
		$errorArr[] = 'email';
		
	}
		
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Prijava</title>

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
                <h4>Prijavite se na svoj nalog</h4>
				<h5><?=$error?$error:''?></h5>
              </div>
              <form method = 'post' class="contactform">                                                 
                <div class="aa-single-field">
                  <label for="email">Email <span class="required">*</span></label>
                  <input type="email" required="required" aria-required="true" value="" name="email">
                </div>
                <div class="aa-single-field">
                  <label for="password">Lozinka <span class="required">*</span></label>
                  <input type="password" name="password"> 
                </div>
                <div class="aa-single-field">
                <label>
                  <input name = 'remember' type="checkbox"> Zapamti me
                </label>                                                          
                </div> 
                <div class="aa-single-submit">
                  <input type="submit" value="Prijavite se" class="aa-browse-btn" name="submit">  
                  <p>Nemate nalog? <a href="register.php">REGISTRACIJA!</a></p>
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