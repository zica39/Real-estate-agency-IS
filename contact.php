<?php
	include './sql_driver.php';
	include './tools.php';
	include './global.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Kontakt</title>

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
  
  <!-- Pre Loader -->
  <div id="aa-preloader-area">
    <div class="pulse"></div>
  </div>
  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-angle-double-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->


  <!-- Start header section -->
  <header id="aa-header">  
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-header-area">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="aa-header-left">
                  <div class="aa-telephone-no">
                    <span class="fa fa-phone"></span>
                     <?=$config['telefon']?>
                  </div>
                  <div class="aa-email hidden-xs">
                    <span class="fa fa-envelope-o"></span> <?=$config['email']?>
                  </div>
                </div>              
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="aa-header-right">
                  <?php nav_bar(); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- End header section -->
  <!-- Start menu section -->
  <section id="aa-menu-area">
    <nav class="navbar navbar-default main-navbar" role="navigation">  
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- LOGO -->                                               
          <!-- Text based logo -->
           <a class="navbar-brand aa-logo" href="#"> <?=$config['naziv']?></a>
           <!-- Image based logo -->
           <!-- <a class="navbar-brand aa-logo-img" href="index.html"><img src="img/logo.png" alt="logo"></a> -->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav navbar-right aa-main-nav">
            <li><a href="index.php">POČETNA</a></li>
			<li><a href="properties.php">NEKRETNINE</a></li>
			 <?php if($user):?><li><a href="my_properties.php">MOJE NEKRETNINE</a></li><?php endif;?>
			<!-- <li><a href="properties-detail.html">PROPERTIES DETAIL</a></li> --> 
            <li><a href="gallery.php">GALERIJA</a></li>                                         
            <li class="active"><a href="#">KONTAKT</a></li>
			<?php if(isAdmin()):?><li><a href="./dashboard/">DASHBOARD</a></li><?php endif;?>
           <!-- <li><a href="404.html">404 PAGE</a></li> -->
          </ul>                            
        </div><!--/.nav-collapse -->         
      </div>          
    </nav> 
  </section>
  <!-- End menu section -->

  <!-- Start Proerty header  -->

  <section id="aa-property-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-property-header-inner">
            <h2>Kontakt stranica</h2>
            <ol class="breadcrumb">
            <li><a href="#">POCETNA</a></li>            
            <li class="active">KONTAKT</li>
          </ol>
          </div>
        </div>
      </div>
    </div>
  </section> 
  <!-- End Proerty header  -->

 <section id="aa-contact">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
          <div class="aa-contact-area">
            <div class="aa-contact-top">
              <div class="aa-contact-top-left">
                <iframe width="100%" height="450" frameborder="0" allowfullscreen="" style="border:0" src="<?=getMapLink()?>"></iframe>
              </div>
              <div class="aa-contact-top-right">
                <h2>Kontakt</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae placeat aspernatur aperiam, quisquam voluptas enim tempore ab itaque nam modi eos corrupti distinctio nobis labore dolorum quae tenetur. Sapiente, sequi.</p>
                <ul class="contact-info-list">
                  <li> <i class="fa fa-phone"></i><?=$config['telefon']?></li>
                  <li> <i class="fa fa-envelope-o"></i> <?=$config['email']?></li>
                  <li> <i class="fa fa-map-marker"></i> <?=$config['adresa']?></li>
                </ul>
              </div>
            </div>
            <div class="aa-contact-bottom">
              <div class="aa-title">
                <h2>Posaljite nam poruku</h2>
                <span></span>
                <p>Vasa email adresa nece biti objavljena, moraju biti popunjena polja oznacena <strong class="required">*</strong></p>
			  </div>
              <div class="aa-contact-form">
                <form action = 'mailer.php' method = 'post' class="contactform">                  
                  <p class="comment-form-author">
                    <label for="author">Ime <span class="required">*</span></label>
                    <input type="text" name="name" value="" size="30" required="required">
                  </p>
                  <p class="comment-form-email">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" name="email" value="" aria-required="true" required="required">
                  </p>
                  <p class="comment-form-url">
                    <label for="subject">Predmet</label>
                    <input type="text" name="subject">  
                  </p>
                  <p class="comment-form-comment">
                    <label for="comment">Poruka</label>
                    <textarea name="comment" cols="45" rows="8" aria-required="true" required="required"></textarea>
                  </p>                
                  <p class="form-submit">
                    <input type="submit" name="submit" class="aa-browse-btn" value="Posalji poruku">
					<span><?php if(isset($_SESSION['msg'])) {echo $_SESSION['msg'];unset($_SESSION['msg']);}?></span>
                  </p>        
                </form>
              </div>
            </div>
          </div>
       </div>
     </div>
   </div>
 </section>


<!-- Footer -->
<?php  include './footer.php'; ?>

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