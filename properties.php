<?php
	include './sql_driver.php';
	include './tools.php';
	include './global.php';
	
	$key = isset($_GET['key'])?$_GET['key']:'';
	$limit = isset($_GET['limit'])?$_GET['limit']:6;
	$offset = isset($_GET['offset'])?$_GET['offset']:0;
	$order = isset($_GET['order'])?$_GET['order']:'';
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Nekretnine</title>

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
            <li><a href="index.php">POČETNA</a></li>
			<li class="active"><a href="#">NEKRETNINE</a></li>
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
            <h2>Nekretnine</h2>
            <ol class="breadcrumb">
            <li><a href="#">POCETNA</a></li>            
            <li class="active">NEKRETNINE</li>
          </ol>
          </div>
        </div>
      </div>
    </div>
  </section> 
  <!-- End Proerty header  -->

  <!-- Start Properties  -->
  <section id="aa-properties">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="aa-properties-content">
            <!-- start properties content head -->
            <div class="aa-properties-content-head">              
              <div class="aa-properties-content-head-left">
                <form action="" class="aa-sort-form">
                  <label for="">Sortiraj po</label>
                  <select id = 'key' name="">
                    <option value="id" selected="Default">Default</option>
                    <option <?=($key == 'cijena')?'selected':''?> value="cijena">Cijena</option>
                    <option <?=($key == 'datum_postavljanja')?'selected':''?> value="datum_postavljanja">Datum</option>
                    <option <?=($key == 'povrsina')?'selected':''?> value="povrsina">Povrsina</option>
					<option <?=($key == 'broj_pregleda')?'selected':''?> value="broj_pregleda">Broj pregleda</option>
                  </select>
                </form>
                <form action="" class="aa-show-form">
                  <label for="">Prikazi</label>
                  <select id = 'limit' name="">
                    <option value="6" selected='6'>6</option>
                    <option <?=($limit == '12')?'selected':''?> value="12">12</option>
                    <option <?=($limit == '24')?'selected':''?> value="24">24</option>
                  </select>
                </form>
				
				<form action="" class="aa-show-form">
                  <label for="">Poredak</label>
                  <select id = 'order' name="">
                    <option value="DESC" selected='opadajuci'>opadajuci</option>
                    <option <?=($order == 'ASC')?'selected':''?> value="ASC">rastuci</option>
                  </select>
                </form>
				
              </div>
              <div class="aa-properties-content-head-right">
                <a id="aa-grid-properties" href="#"><span class="fa fa-th"></span></a>
                <a id="aa-list-properties" href="#"><span class="fa fa-list"></span></a>
              </div>            
            </div>
            <!-- Start properties content body -->
            <div class="aa-properties-content-body">
              <ul class="aa-properties-nav">
				<?php $count = draw_cards_list();?>
              </ul>
            </div>
            <!-- Start properties content bottom -->
            <div class="aa-properties-content-bottom">
			  <?php 
				$pag_count = ceil($count/$limit);
				$active = $offset + 1;
			  ?>
              <nav>
                <ul id = 'pag' class="pagination">
                  <li>
                    <a href="#" class = "<?=($active == 1)?'disabled':''?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>
				  <?php
					for($i = 1; $i<= $pag_count; $i++){
						$sel = ($active == $i)?'disabled':'';
						echo "<li><a class = $sel href='#'>$i</a></li>"	;
					}
				  ?>
                  <li>
                    <a href="#"  class = "<?=($active == $pag_count)?'disabled':''?>" aria-label="Next">
                      <span aria-hidden="true">&raquo;</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
        <!-- Start properties sidebar -->
        <!-- Start properties sidebar -->
        <div class="col-md-4">
          <aside class="aa-properties-sidebar">
            <!-- Start Single properties sidebar -->
            <div class="aa-properties-single-sidebar">
              <h3>Pretraga nekretnina</h3>
              <form id = 'search-form' action="" method='get'>
                <div class="aa-single-advance-search">
                  <input type="text" name = 'q' placeholder="Kljucna rijec pretrage..." value = '<?=isset($_GET['q'])?$_GET['q']:'';?>'>
                </div>
                <div class="aa-single-advance-search">
                  <select selected = '' id="" name="tip_oglasa">
                   <option value="0">Tip Oglasa</option>
                    <?php 
					$rez = mysqli_query($db_conn,'select * from tip_oglasa');
					$tip_oglasa = isset($_GET['tip_oglasa'])?$_GET['tip_oglasa']:'';
					while($row = mysqli_fetch_assoc($rez)){
						$id  = $row['id'];
						$naziv = $row['naziv'];
						$selected = ($tip_oglasa == $id)?'selected':'';
						echo "<option $selected value = '$id' >$naziv</option>";
					}
					?>
                  </select>
                </div>
                <div class="aa-single-advance-search">
                  <select id="" name="tip_nekretnine">
                    <option selected="" value="0">Tip Neretnine</option>
                    <?php 
					$rez = mysqli_query($db_conn,'select * from tip_nekretnine');
					$tip_nekretnine = isset($_GET['tip_nekretnine'])?$_GET['tip_nekretnine']:'';
					while($row = mysqli_fetch_assoc($rez)){
						$id  = $row['id'];
						$naziv = $row['naziv'];
						$selected = ($tip_nekretnine == $id)?'selected':'';
						echo "<option $selected value = '$id' >$naziv</option>";
					}
					?>
                  </select>
                </div>
                <div class="aa-single-advance-search">
                  <select id="" name="grad">
                    <option selected="" value="0">Grad</option>
                    <?php 
					$rez = mysqli_query($db_conn,'select * from grad');
					$grad = isset($_GET['grad'])?$_GET['grad']:'';
					while($row = mysqli_fetch_assoc($rez)){
						$id  = $row['id'];
						$naziv = $row['naziv'];
						$selected = ($grad == $id)?'selected':'';
						echo "<option $selected value = '$id' >$naziv</option>";
					}
					?>
                  </select>
                </div>
                <div class="aa-single-filter-search">
                  <span>Površina (m<sup>2</sup>)</span>
                <span>OD</span>
                <span id="skip-value-lower" class="example-val"><?=isset($_GET['povrsina_od'])?$_GET['povrsina_od']:'30.00';?></span>
                <span>DO</span>
                <span id="skip-value-upper" class="example-val"><?=isset($_GET['povrsina_do'])?$_GET['povrsina_do']:'100.00';?></span>
                <div id="aa-sqrfeet-range" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                </div>                 
                </div>
                <div class="aa-single-filter-search">
                  <span>Cijena (€)</span>
                <span>OD</span>
                <span id="skip-value-lower2" class="example-val"><?=isset($_GET['cijena_od'])?$_GET['cijena_od']:'30.00';?></span>
                <span>DO</span>
                <span id="skip-value-upper2" class="example-val"><?=isset($_GET['cijena_do'])?$_GET['cijena_do']:'100.00';?></span>
                <div id="aa-price-range" class="noUi-target noUi-ltr noUi-horizontal noUi-background">
                </div>      
                </div>
                <div class="aa-single-advance-search">
                  <input type="submit" value="Search" class="aa-search-btn">
                </div>
				<input type = 'hidden' name = 'cijena_od' id = 'cijena_od' value = '<?=isset($_GET['cijena_od'])?$_GET['cijena_od']:'';?>'>
				<input type = 'hidden' name = 'cijena_do' id = 'cijena_do' value = '<?=isset($_GET['cijena_do'])?$_GET['cijena_do']:'';?>'>
				<input type = 'hidden' name = 'povrsina_od' id = 'povrsina_od' value = '<?=isset($_GET['povrsina_od'])?$_GET['povrsina_od']:'';?>'>
				<input type = 'hidden' name = 'povrsina_do' id = 'povrsina_do' value = '<?=isset($_GET['povrsina_do'])?$_GET['povrsina_do']:'';?>'>
				<script>
				var cijena_od = <?=isset($_GET['cijena_od'])?$_GET['cijena_od']:0.00;?>;
				var cijena_do = <?=isset($_GET['cijena_do'])?$_GET['cijena_do']:10000.00;?>;
				
				var povrsina_od = <?=isset($_GET['povrsina_od'])?$_GET['povrsina_od']:0.00;?>;
				var povrsina_do = <?=isset($_GET['povrsina_do'])?$_GET['povrsina_do']:1000.00;?>;
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