<?php
	include './sql_driver.php';
	include './tools.php';
	include './global.php';
	
	if(doesEstateExists($_GET['id']) == false)header('Location:404.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Detalji nekretnine</title>

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
			<li class=""><a href="properties.php">NEKRETNINE</a></li>
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

  <!-- Start Proerty header  -->

  <section id="aa-property-header">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-property-header-inner">
            <h2>Detalji nekretnine</h2>
            <ol class="breadcrumb">
            <li><a href="index.php">POCETNA</a></li>            
            <li class="active">DETALJI NEKRETNINE</li>
          </ol>
          </div>
        </div>
      </div>
    </div>
  </section> 
  <!-- End Proerty header  -->

	<?php 
		$nekretnina = get_by_id($_GET['id']);
		$br_pregleda = $nekretnina['broj_pregleda'] + 1;
		$id = $nekretnina['id'];
		
		mysqli_query($db_conn,"UPDATE nekretnina SET broj_pregleda=$br_pregleda WHERE id=$id");
	?>
  <!-- Start Properties  -->
  <section id="aa-properties">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="aa-properties-content">            
            <!-- Start properties content body -->
            <div class="aa-properties-details">
			<div class='box'>
				 <div class="aa-properties-details-img">
					 <?php
						get_photos($nekretnina);
					 ?>
				 </div>
				 <?php if($nekretnina['status']=='prodato'):?><div class="ribbon ribbon-top-right"><span>Prodato</span></div><?php endif; ?>
			 </div>
             <div class="aa-properties-info">
				<small><p><b>Datum postavljanja: </b> <?=date($nekretnina['datum_postavljanja'])?> <span style = 'float:right;'>👁️‍🗨️ <?=$nekretnina['broj_pregleda']?></span></p></small>
               <h2><?=ucfirst($nekretnina['tip_nekretnine'])?> -  
					<?=$nekretnina['povrsina']?>m<sup>2</sup> -
					<?=$nekretnina['cijena']?> €
					
					
					<?php if(is_array($user))if($user['id'] == $nekretnina['korisnik_id']): ?>
					<span style='float:right;' class="aa-properties-detial">
							<a data-del href="properties-remove.php?id=<?=$nekretnina['id']?>" title = 'Obrisi oglas' class="aa-secondary-btn"><i class="fa fa-trash"></i></a>
							<a href="properties-edit.php?id=<?=$nekretnina['id']?>" title = 'Izmjeni oglas'  class="aa-secondary-btn"><i class="fa fa-pencil"></i></a>
							<?php if($nekretnina['status']=='dostupno'):?><a href="properties-sold.php?id=<?=$nekretnina['id']?>" title = 'Oznaci kao prodato' class="aa-secondary-btn"><i class="fa fa-thumb-tack"></i></a>
							<?php else:?><a href="properties-unsold.php?id=<?=$nekretnina['id']?>" title = 'Oznaci kao dostupno' class="aa-secondary-btn"><i class="fa fa-thumb-tack" style="transform: rotate(-45deg);"></i></a><?php endif; ?>
					</span>
					<?php endif; ?>
					
					<?php if(isAdmin() && ($config['admin'] != $nekretnina['korisnik_id'])):?><a data-del-admin href="properties-remove-admin.php?id=<?=$nekretnina['id']?>" title = 'Unlonite neprikladan oglas' style='float:right;' class="aa-secondary-btn a-m1"><i class="fa fa-ban"></i></a><?php endif; ?>
			   </h2>
			   
			  <div class="row">
				  <div class="col-md-6">
						<h4>Osnovni podaci:</h4>
					   <p><b>Status: </b><?=ucfirst($nekretnina['status'])?></p>
					   <p><b>Tip oglasa: </b><?=ucfirst($nekretnina['tip_oglasa'])?></p>
					    <p><b>Tip nekretnine: </b><?=ucfirst($nekretnina['tip_nekretnine'])?></p>
					   <?php if($nekretnina['datum_prodaje']): ?><p><b>Datum prodaje: </b> <?=$nekretnina['datum_prodaje']?></p><?php endif; ?>
					   <p><b>Lokacija: </b>Crna-Gora / <?=$nekretnina['grad_naziv']?></p>
					   <p><b>Povrsina: </b><?=$nekretnina['povrsina']?>m<sup>2</sup></p>
					   <p><b>Cijena: </b><?=$nekretnina['cijena']?> €</p>
					   <p><b>Godina izgradnje: </b> <?=$nekretnina['godina_izgradnje']??'N/A'?></p>
				   </div>
				    <div class="col-md-6">
						<?php $owner = get_owner_by_id($nekretnina['korisnik_id']); ?>
						<h4>Kontakt podaci:</h4>
						<p><b>Korisnicko ime: </b><?=$owner['ime']?></p>
						<p><b>Email: </b><?=$owner['email']?></p>
						<p><b>Telefon: </b><?=$nekretnina['telefon']??'N/A'?><i class="fa fa-viber"></i></p>
						
					</div>
				</div>
				
				<h4>Opis:</h4>
				<p style='word-break: break-all;'><b></b><?=$nekretnina['opis']?></p>
				
				
			  
               <h4>Dodatna opremljenost:</h4>
               <ul>
				<?php
				$svojstva = explode(',',$nekretnina['svojstva']);
					if(is_array($svojstva))
						foreach($svojstva as $svojstvo)
							if($svojstvo)
								echo " <li>$svojstvo</li>";
				?>
               </ul>
			   
               <h4>Adresa:</h4>
			   <address><?=$nekretnina['adresa']??'N/A'?></address>
			    <?php 
					$adresa = str_ireplace(' ','+',$nekretnina['adresa']).'+'.$nekretnina['grad_naziv'];
					$api_key = $config['map_api'];
				?>
				
               <iframe src="https://www.google.com/maps/embed/v1/place?key=<?=$api_key?>&q=<?=$adresa?>" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				
				<!--<h4>Property Video</h4>
               <iframe width="100%" height="480" src="https://www.youtube.com/embed/CegXQps0In4" frameborder="0" allowfullscreen></iframe>
				-->
				
			</div>
			 
			 <!-- Properties social share -->
             <div class="aa-properties-social">
               <ul>
                 <li>Share</li>
                 <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                 <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                 <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                 <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
               </ul>
             </div>
             <!-- Nearby properties -->
             <div class="aa-nearby-properties">
               <div class="aa-title">
                 <h2>Slicni Oglasi</h2>
                 <span></span>
               </div>
               <div class="aa-nearby-properties-area">
                 <div class="row">
					<?php draw_cards_nearby($nekretnina['id'],$nekretnina['tip_oglasa_id'],$nekretnina['tip_nekretnine_id'],$nekretnina['grad']);?>
                 </div>
               </div>

             </div>
             

            </div>           
          </div>
        </div>
        <!-- Start properties sidebar -->
        <div class="col-md-4">
          <aside class="aa-properties-sidebar">
			<?php if(isAdmin()):?><div class="aa-properties-single-sidebar">
			  <h3>Moje nekretnine</h3>
			  <p>Korisnicko ime: <span><?=$user['username']?></span><p>
			  <!--<p>Broj oglasa: <span><?=$count?></span><p>-->
			  <form>
			  <div class="aa-single-advance-search">
                  <input type="submit" formaction='properties-add.php' value="Dodaj oglas" class="aa-search-btn">
				   <input type="submit" formaction='my_properties.php' value="Moje nekretnine" class="aa-search-btn">
                </div>
			   </form>
			</div><?php endif; ?>
            <!-- Start Single properties sidebar -->
            <div class="aa-properties-single-sidebar">
              <h3>Pretraga nekretnina</h3>
              <form id = 'search-form' action="./properties.php">
                <div class="aa-single-advance-search">
                  <input type="text" name = 'q' placeholder="Kljucna rijec pretrage...">
                </div>
                <div class="aa-single-advance-search">
                  <select id="" name="tip_oglasa">
                   <option selected="" value="0">Tip Oglasa</option>
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
                <div class="aa-single-advance-search">
                  <select id="" name="tip_nekretnine">
                    <option selected="" value="0">Tip Neretnine</option>
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
                <div class="aa-single-advance-search">
                  <select id="" name="grad">
                    <option selected="" value="0">Grad</option>
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
                <div class="aa-single-filter-search">
                  <span>Površina (m<sup>2</sup>)</span>
                <span>OD</span>
                <span id="skip-value-lower" class="example-val">30.00</span>
                <span>DO</span>
                <span id="skip-value-upper" class="example-val">100.00</span>
                <div id="aa-sqrfeet-range" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                </div>                 
                </div>
                <div class="aa-single-filter-search">
                  <span>Cijena (€)</span>
                <span>OD</span>
                <span id="skip-value-lower2" class="example-val">30.00</span>
                <span>DO</span>
                <span id="skip-value-upper2" class="example-val">100.00</span>
                <div id="aa-price-range" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                </div>      
                </div>
                <div class="aa-single-advance-search">
                  <input type="submit" value="Search" class="aa-search-btn">
                </div>
				
				<input type = 'hidden' name = 'cijena_od' id = 'cijena_od'>
				<input type = 'hidden' name = 'cijena_do' id = 'cijena_do'>
				<input type = 'hidden' name = 'povrsina_od' id = 'povrsina_od'>
				<input type = 'hidden' name = 'povrsina_do' id = 'povrsina_do'>
				<script>
					var cijena_od = 0.00;
					var cijena_do = 10000.00;
					
					var povrsina_od = 0.00;
					var povrsina_do = 1000.00;
				</script>
		
              </form>
            </div> 
            <!-- Start Single properties sidebar -->
            <div class="aa-properties-single-sidebar">
              <h3>Popularne Nekretnine</h3>
              <?php get_top_n(3)?>
            </div>
          </aside>
        </div>
      </div>
    </div>
  </section>
  <!-- / Properties  -->

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