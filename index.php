<?php
	include './sql_driver.php';
	include './tools.php';
	include './global.php';
	
	count_traffic();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Pocetna</title>
    
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
  <body class="aa-price-range">  
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
                    <span class="fa fa-envelope-o"></span>  <?=$config['email']?>
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
            <li class="active"><a href="#">POČETNA</a></li>
			<li><a href="properties.php">NEKRETNINE</a></li>
			 <?php if($user):?><li><a href="my_properties.php">MOJE NEKRETNINE</a></li><?php endif;?>
			<!-- <li><a href="properties-detail.html">PROPERTIES DETAIL</a></li> --> 
            <li><a href="gallery.php">GALERIJA</a></li>                                         
            <li><a href="contact.php">KONTAKT</a></li>
			<?php if(isAdmin()):?><li><a href="./dashboard/">DASHBOARD</a></li><?php endif;?>
           <!-- <li><a href="404.html">404 PAGE</a></li> -->
          </ul>                            
        </div><!--/.nav-collapse -->       
      </div>          
    </nav> 
  </section>
  <!-- End menu section -->

  <!-- Start slider  -->
  <section id="aa-slider">
    <div class="aa-slider-area"> 
      <!-- Top slider -->
      <div class="aa-top-slider">
        <!-- Top slider single slide -->
        <?php fill_carosel(); ?>
        <!-- / Top slider single slide -->
      </div>
    </div>
  </section>
  <!-- End slider  -->

  <!-- Advance Search -->
  <section id="aa-advance-search">
    <div class="container">
      <div class="aa-advance-search-area">
	  <form id = 'search-form' method = 'get' action = './properties.php'>
        <div class="form">
         <div class="aa-advance-search-top">
            <div class="row">
              <div class="col-md-4">
                <div class="aa-single-advance-search">
                  <input name = 'q' type="text" placeholder="Ključna rijec pretrage...">
                </div>
              </div>
              <div class="col-md-2">
                <div class="aa-single-advance-search">
                  <select name = 'tip_oglasa'>
                   <option value="0" selected>Tip Oglasa</option>
                    <?php 
					$rez = mysqli_query($db_conn,'select * from tip_oglasa');
					while($row = mysqli_fetch_assoc($rez)){
						$id  = $row['id'];
						$naziv = $row['naziv'];
						echo "<option value = '$id' >$naziv</option>";
					}
					?>
                  </select>
                </div>
              </div>
              <div class="col-md-2">
                 <div class="aa-single-advance-search">
                  <select name = 'tip_nekretnine'>
                    <option value="0" selected>Tip Nekretnine</option>
                    <?php 
					$rez = mysqli_query($db_conn,'select * from tip_nekretnine');
					while($row = mysqli_fetch_assoc($rez)){
						$id  = $row['id'];
						$naziv = $row['naziv'];
						echo "<option value = '$id' >$naziv</option>";
					}
					?>
                  </select>
              </div>
              </div>
              <div class="col-md-2">
                 <div class="aa-single-advance-search">
                  <select name = 'grad'>
                    <option value="0" selected>Grad</option>
                    <?php 
					$rez = mysqli_query($db_conn,'select * from grad');
					while($row = mysqli_fetch_assoc($rez)){
						$id  = $row['id'];
						$naziv = $row['naziv'];
						echo "<option value = '$id' >$naziv</option>";
					}
					?>
                  </select>
              </div>
              </div>
              <div class="col-md-2">
                <div class="aa-single-advance-search">
                  <input class="aa-search-btn" type="submit" value="Search">
                </div>
              </div>
            </div>
          </div>
         <div class="aa-advance-search-bottom">
           <div class="row">
            <div class="col-md-6">
              <div class="aa-single-filter-search">
                <span>Površina (m<sup>2</sup>)</span>
                <span>OD</span>
                <span id="skip-value-lower" class="example-val">30.00</span>
                <span>DO</span>
                <span id="skip-value-upper" class="example-val">100.00</span>
                <div id="aa-sqrfeet-range" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                </div>                  
              </div>
            </div>
            <div class="col-md-6">
              <div class="aa-single-filter-search">
                <span>Cijena (€)</span>
                <span>OD</span>
                <span id="skip-value-lower2" class="example-val">30.00</span>
                <span>DO</span>
                <span id="skip-value-upper2" class="example-val">100.00</span>
                <div id="aa-price-range" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                </div>      
              </div>
            </div>
          </div>  
         </div>
        </div>
		<input type = 'hidden' name = 'cijena_od' id = 'cijena_od'>
		<input type = 'hidden' name = 'cijena_do' id = 'cijena_do'>
		<input type = 'hidden' name = 'povrsina_od' id = 'povrsina_od'>
		<input type = 'hidden' name = 'povrsina_do' id = 'povrsina_do'>
		
		<script>
			var cijena_od = <?=isset($_GET['cijena_od'])?$_GET['cijena_od']:0.00;?>;
			var cijena_do = <?=isset($_GET['cijena_do'])?$_GET['cijena_do']:10000.00;?>;
			
			var povrsina_od = <?=isset($_GET['povrsina_od'])?$_GET['povrsina_od']:0.00;?>;
			var povrsina_do = <?=isset($_GET['povrsina_do'])?$_GET['povrsina_do']:1000.00;?>;
		</script>
	
		</form>
      </div>
    </div>
  </section>
  <!-- / Advance Search -->
	
  <!-- Latest property -->
  <section id="aa-latest-property">
    <div class="container">
      <div class="aa-latest-property-area">
        <div class="aa-title">
          <h2>Noviji oglasi</h2>
          <span></span>
          <p>Oglasi koji su nedavno postavljeni na sajtu.</p>         
        </div>
        <div class="aa-latest-properties-content">
          <div class="row">
			<?php draw_cards(); ?>
          </div>
        </div>
      </div>
    </div>
	
	<div class="aa-promo-banner-area" style = 'display:flex;justify-content:center;padding-top:25px;' >
		<a href="properties.php?key=datum_postavljanja" class="aa-view-btn">Pogledaj sve</a>
	</div>

  </section>
  <!-- / Latest property -->

  <!-- Service section -->
  <section id="aa-service">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-service-area">
            <div class="aa-title">
              <h2>Nase usluge</h2>
              <span></span>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum sit ea nobis quae vero voluptatibus.</p>
            </div>
            <!-- service content -->
            <div class="aa-service-content">
              <div class="row">
                <div class="col-md-3">
                  <div class="aa-single-service">
                    <div class="aa-service-icon">
                      <span class="fa fa-home"></span>
                    </div>
                    <div class="aa-single-service-content">
                      <h4><a href="#">Prodaja nekretnina</a></h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto repellendus quasi asperiores itaque dolorem at.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="aa-single-service">
                    <div class="aa-service-icon">
                      <span class="fa fa-check"></span>
                    </div>
                    <div class="aa-single-service-content">
                      <h4><a href="#">Oglasavanje nekretnina</a></h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto repellendus quasi asperiores itaque dolorem at.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="aa-single-service">
                    <div class="aa-service-icon">
                      <span class="fa fa-crosshairs"></span>
                    </div>
                    <div class="aa-single-service-content">
                      <h4><a href="#">Savjeti za ulaganje</a></h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto repellendus quasi asperiores itaque dolorem at.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="aa-single-service">
                    <div class="aa-service-icon">
                      <span class="fa fa-bar-chart-o"></span>
                    </div>
                    <div class="aa-single-service-content">
                      <h4><a href="#">Analiza trzista</a></h4>
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto repellendus quasi asperiores itaque dolorem at.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Service section -->

  <!-- Promo Banner Section -->
  <section id="aa-promo-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-promo-banner-area">
            <h3>Postavite svoje nekretnine</h3>
            <p>Postavite svoje oglase potpuno besplatno, da biste koristili ovu uslugu morate biti prijavljeni.</p>
            <a href="properties-add.php" class="aa-view-btn">Dodaj nekretninu</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / Promo Banner Section -->
	
  <!-- About us -->
  <section id="aa-about-us">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-about-us-area">
            <div class="row">
              <div class="col-md-5">
                <div class="aa-about-us-left">
                  <img src="img/about-us.png" alt="image">
                </div>
              </div>
              <div class="col-md-7">
                <div class="aa-about-us-right">
                  <div class="aa-title">
                    <h2>O nama</h2>
                    <span></span>
                  </div>
                  <p  style='padding:10%;text-align:center;'>  <?=$config['o_nama']?></p>                  
                  <!--<ul>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, blanditiis.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia.</li>                    
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, blanditiis.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</li>
                    <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia.</li>
                  </ul>-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- / About us -->
  
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
  <script>
   setInterval(function(){
	$('button.slick-next.slick-arrow').click(); 
	},5000);
  </script>
  </body>
</html>