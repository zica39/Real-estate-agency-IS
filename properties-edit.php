<?php
	include './sql_driver.php';
	include './tools.php';
	include './global.php';
	
	if(!is_array($user))header('Location:./index.php');
	
	$nekretnina = get_by_id($_GET['id']);
	if($nekretnina['korisnik_id'] != $user['id'])die('Pogresan ID...');
	
	
	$error = '';
	$errorArr = [];
	$msg = '';
	
if(isset($_POST['submit'])){
	
	$tip_oglasa = isset($_POST['tip_oglasa'])?$_POST['tip_oglasa']:false;
	$tip_nekretnine = isset($_POST['tip_nekretnine'])?$_POST['tip_nekretnine']:false;
	$grad = isset($_POST['grad'])?$_POST['grad']:false;
	$cijena = isset($_POST['cijena'])?$_POST['cijena']:false;
	$povrsina = isset($_POST['povrsina'])?$_POST['povrsina']:false;
	$opis = isset($_POST['opis'])?$_POST['opis']:false;
	$godina_izgradnje = isset($_POST['godina_izgradnje'])?$_POST['godina_izgradnje']:false;
	
	$telefon = isset($_POST['telefon'])?$_POST['telefon']:false;
	$adresa = isset($_POST['adresa'])?$_POST['adresa']:false;
	$svojstva = isset($_POST['svojstva'])?$_POST['svojstva']:false;
	
	$status =  isset($_POST['status'])?$_POST['status']:false;
	
	if($status == 2)$datum_prodaje = 'CURDATE()';
	else $datum_prodaje = 'null';
	
	$korisnik_id = $user['id'];
	$id_nekretnine = $_GET['id'];
	
	/* echo $tip_oglasa,$tip_nekretnine,$grad,$status,$cijena,$povrsina,$godina_izgradnje,$status,"'$opis'";
	die(); */
	
	$rez = mysqli_query($db_conn,"UPDATE nekretnina SET tip_oglasa=$tip_oglasa, tip_nekretnine=$tip_nekretnine, status=$status,
	grad=$grad, cijena=$cijena, opis='$opis', godina_izgradnje=YEAR('$godina_izgradnje'), telefon='$telefon', adresa='$adresa', svojstva='$svojstva', datum_prodaje = $datum_prodaje
	WHERE korisnik_id = $korisnik_id AND id = $id_nekretnine");
	
	if($rez){
		
	$fotografije = [];
	$file = $_FILES['fotografije'];
	
	$mgr = isset($_POST['mgr'])?$_POST['mgr']:false;
	if($mgr)$mgr = json_decode($mgr);
	else $mgr = [];
	
	for($i=0; $i < count($file['tmp_name']);$i++){
		$tmp_name = $file['tmp_name'][$i];
		$name = $file['name'][$i];
		if(!in_array($name,$mgr))continue;
		$type = explode('/', $file['type'][$i])[1];
		$file_type = explode('/', $file['type'][$i])[0];
		if($file_type != 'image')continue;
		$new_name = uniqid().'.'.$type;
		move_uploaded_file($tmp_name, photo_path.$new_name);
		$fotografije[] = $new_name;	
	}
	
	$postojece = isset($_POST['postojece'])?$_POST['postojece']:false;
	if($postojece)$postojece = json_decode($postojece);
	else $postojece = [];
	
	$photos = json_encode(array_merge($fotografije,$postojece));
		
		if($photos){
			mysqli_query($db_conn,"UPDATE nekretnina SET fotografije = '$photos' WHERE id = $id_nekretnine AND korisnik_id = $korisnik_id");
		}
		
		header("Location:./properties-detail.php?id=$id_nekretnine");
	}
}
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title>Izmjena oglas</title>

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
	<!-- Main style sheet -->
    <link href="css/form.css" rel="stylesheet">  

   
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
            <h2>Izmjena oglasa</h2>
            <ol class="breadcrumb">
            <li><a href="index.php">POCETNA</a></li>            
            <li class="active">IZMJENA OGLASA</li>
          </ol>
          </div>
        </div>
      </div>
    </div>
  </section> 
  <!-- End Proerty header  -->

	<?php 
		//$nekretnina = get_by_id($_GET['id']);
	?>
  <!-- Start Properties  -->
  <section id="aa-properties">
  
    <div class="container1">
      <div class="row">
        <div class="col-md-8">
          <div class="aa-properties-content">            
            <!-- Start properties content body -->
            <div class="aa-properties-details">
             <div class="aa-properties-info">
               
			<div class="container1">
				<div class="aa-title">
					<h2>Izmjeni oglas</h2>
					<span></span>
					
				  </div>
			  
				  <form id = 'dodaj_oglas' method = 'post' class="contactform" enctype = 'multipart/form-data'>
				  <div class="row">
					<div class="col-25">
					  <label for="status">Status</label>
					</div>
					<div class="col-75">
					  <select id="status" name="status" required>
						<?php 
						$rez = mysqli_query($db_conn,'select * from status_nekretnine');
						while($row = mysqli_fetch_assoc($rez)){
							$id  = $row['id'];
							$naziv = $row['naziv'];
							$selected = ($id == $nekretnina['status_id'])?'selected':'';
							echo "<option $selected value = '$id' >$naziv</option>";
						}
						?>
					  </select>
					</div>
				  </div>
				  
				  <div class="row">
					<div class="col-25">
					  <label for="tip_oglasa">Tip Oglasa</label>
					</div>
					<div class="col-75">
					  <select id="tip_oglasa" name="tip_oglasa" required>
						<?php 
						$rez = mysqli_query($db_conn,'select * from tip_oglasa');
						while($row = mysqli_fetch_assoc($rez)){
							$id  = $row['id'];
							$naziv = $row['naziv'];
							$selected = ($id == $nekretnina['tip_oglasa_id'])?'selected':'';
							echo "<option $selected value = '$id' >$naziv</option>";
						}
						?>
					  </select>
					</div>
				  </div>
				  
				  <div class="row">
					<div class="col-25">
					  <label for="tip_nekretnine">Tip Nekretnine</label>
					</div>
					<div class="col-75">
					   <select id="tip_nekretnine" name="tip_nekretnine" required>
						<option selected="" value="" hidden>--Odaberi tip nekretnine--</option>
						<?php 
						$rez = mysqli_query($db_conn,'select * from tip_nekretnine');
						while($row = mysqli_fetch_assoc($rez)){
							$id  = $row['id'];
							$naziv = $row['naziv'];
							$selected = ($id == $nekretnina['tip_nekretnine_id'])?'selected':'';
							echo "<option $selected value = '$id' >$naziv</option>";
						}
						?>
					  </select>
					</div>
				  </div>
				  
				  <div class="row">
					<div class="col-25">
					  <label for="grad">Grad</label>
					</div>
					<div class="col-75">
					   <select id="grad" name="grad" required>
						<option selected="" value="" hidden>--Odaberi grad--</option>
						<?php 
						$rez = mysqli_query($db_conn,'select * from grad');
						while($row = mysqli_fetch_assoc($rez)){
							$id  = $row['id'];
							$naziv = $row['naziv'];
							$selected = ($id == $nekretnina['grad'])?'selected':'';
							echo "<option $selected value = '$id' >$naziv</option>";
						}
						?>
					  </select>
					</div>
				  </div>
				  
				  
				  <div class="row">
					<div class="col-25">
					  <label for="cijena">Cijena</label>
					</div>
					<div class="col-75">
						<input type="number" id="cijena" name="cijena" value="<?=$nekretnina['cijena']?>" size="30" required="required">
					</div>
				  </div>
				  
				  <div class="row">
					<div class="col-25">
					  <label for="povrsina">Povrsina</label>
					</div>
					<div class="col-75">
						<input type="number" id="povrsina" name="povrsina" value="<?=$nekretnina['povrsina']?>" size="30" required="required">
					</div>
				  </div>
				  
				  <div class="row">
					<div class="col-25">
					  <label for="godina_izgradnje">Godina izgradnje</label>
					</div>
					<div class="col-75">
						 <input type="date" id="godina_izgradnje" name="godina_izgradnje" value="<?=$nekretnina['godina_izgradnje']?>-01-01" size="30" >
					</div>
				  </div>
				  
				  <div class="row">
					<div class="col-25">
					  <label for="telefon">Telefon</label>
					</div>
					<div class="col-75">
						 <input type="tel" id="telefon" name="telefon" value="<?=$nekretnina['telefon']?>" placeholder = '+3826XXXXXX'  >
					</div>
				  </div>
				  
				  <div class="row">
					<div class="col-25">
					  <label for="adresa">Adresa</label>
					</div>
					<div class="col-75">
						 <input type="text" id="adresa" name="adresa" value="<?=$nekretnina['adresa']?>" size="20" >
					</div>
				  </div>
				  
				   <div class="row">
					<div class="col-25">
					  <label for="svojstva_inp">Dodatna opremljenost</label>
					</div>
					<div class="col-75">
						  <div>
						<multi-input>
						  <input id = 'svojstva_inp' list="speakers">
						  <datalist id="speakers">
							<option value="Klima"></option>
							<option value="Internet"></option>
							<option value="Grijanje"></option>
							<option value="2 Sobe"></option>
							<option value="3 Sobe"></option>
							<option value="2 Kupatila"></option>
							<option value="Parking"></option>
							<option value="Basta"></option>
							<option value="Tavan"></option>
							<option value="Lift"></option>
							<option value="Video nadzor"></option>
						  </datalist>
						</multi-input>
					  </div>
					  <input type="hidden" name="svojstva" value="<?=$nekretnina['svojstva']?>">
					</div>
				  </div>
				  
				  <div class="row">
					<div class="col-25">
					  <label for="files">Fotografije</label>
					</div>
					<div class="col-75">
						<input type="button" onclick = 'document.getElementById("files").click();' value="📁 Choose...">
						<div class="field" align="left">
						  <input type="file" id="files" style='display:none;' name="fotografije[]" value="" multiple accept = 'image/*'>
						</div>
						<div class="field1" align="left"></div>
					</div>
				  </div>
				  
				  <input type="hidden" name="mgr" value="">
				  
				   <input type="hidden" name="postojece" value='<?=$nekretnina['fotografije']?>' data-path=<?=photo_path?>>
				  
				  <div class="row">
					<div class="col-25">
					  <label for="opis">Opis</label>
					</div>
					<div class="col-75">
					  <textarea id="opis" name="opis" placeholder="Write something.." style="height:200px"><?=$nekretnina['opis']?></textarea>
					</div>
				  </div>
				  
				   <div class="row">
					<input type="submit" name="submit" value="Izmjeni oglas">
				  </div>
				  
				  </form>
			</div>
			
			</div>
             
			<!--
			<div class="aa-properties-details-img">
               <img src="img/slider/1.jpg" alt="img">
               <img src="img/slider/2.jpg" alt="img">
               <img src="img/slider/3.jpg" alt="img">
             </div>-->
             

            </div>           
          </div>
        </div>
        <!-- Start properties sidebar -->
        <div class="col-md-4">
          <aside class="aa-properties-sidebar">
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
   <!-- Input tag js -->
  <script src="js/multi-input.js"></script>
  
  <script>show_current_images();</script>
  <script>fill_input_tag();</script>
  </body>
</html>