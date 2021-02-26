<?php
define('photo_path','./img/users/');

function get_by_id($id){
	global $db_conn;
			
	$rez = mysqli_query($db_conn,"SELECT * FROM nekretnina WHERE id = $id");
	$row = mysqli_fetch_assoc($rez);
		
	$tip_id = $row['tip_nekretnine'];
	$row['tip_nekretnine_id'] = $tip_id;
	$tip_nekretnine = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM tip_nekretnine WHERE id = $tip_id"))['naziv'];
	
	$tip_id = $row['status'];
	$row['status_id'] = $tip_id;
	$status = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM status_nekretnine WHERE id = $tip_id"))['naziv'];
	
	
	$tip_id = $row['tip_oglasa'];
	$row['tip_oglasa_id'] = $tip_id;
	$tip_oglasa = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM tip_oglasa WHERE id = $tip_id"))['naziv'];
	
	$tip_id = $row['grad'];
	$grad_naziv = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM grad WHERE id = $tip_id"))['naziv'];
	$row['grad_naziv'] = $grad_naziv;
	
	$row['tip_nekretnine'] = $tip_nekretnine;
	$row['status'] = $status;
	$row['tip_oglasa'] = $tip_oglasa;
	
	return $row;
	
}

function getConfig(){
	global $db_conn;
			
	$res = mysqli_query($db_conn,"SELECT * FROM agencija");
	$row = mysqli_fetch_assoc($res);
	return $row;
}

function isAdmin(){
	
	global $user,$config;
	
	if(is_array($user))if($user['id'] == $config['admin'])return true;
	
	return false;
}

function getMapLink(){
		
	global $config;

	$adresa = str_ireplace(' ','+',$config['adresa']);/* .'+'.$config['sjediste']; */
	$api_key = $config['map_api'];

			
	return "https://www.google.com/maps/embed/v1/place?key=$api_key&q=$adresa";	
}

function get_owner_by_id($id){
	global $db_conn;
			
	$rez = mysqli_query($db_conn,"SELECT * FROM korisnik WHERE id = $id");
	$row = mysqli_fetch_assoc($rez);
	
	return $row;
	
}

function set_gallery_buttons(){
	global $db_conn;
	
	echo '<li data-filter="all" class="filter active">SVE</li>';
	
	$rez = mysqli_query($db_conn,'select * from tip_nekretnine');
	while($row = mysqli_fetch_assoc($rez)){
		$id  = $row['id'];
		$naziv = $row['naziv'];
		echo "<li data-filter='.id$id' class='filter'>$naziv</li>";
	}
}

function fill_carosel(){
global $db_conn,$config;
			
		$admin_id = $config['admin'];
		$rez = mysqli_query($db_conn,"SELECT * FROM nekretnina n WHERE status <> 2 AND korisnik_id = $admin_id");
		
		if(mysqli_num_rows($rez) == 0){
			
			?>
			<div class="aa-top-slider-single">
			  <img src="img/signin-bg.jpg" alt="img">
			  <!-- Top slider content -->
			  <div class="aa-top-slider-content">
				<h2 class="aa-top-slider-title">Welcome to <?=$config['naziv']?></h2>
				
			  </div>
			  <!-- / Top slider content -->
			</div>
			<?php
			
		}
		
		while($row = mysqli_fetch_assoc($rez)){
			$nek = get_by_id($row['id']);
			
			?>
			<div class="aa-top-slider-single">
			  <img src="<?=get_first_photo($row);?>" alt="img">
			  <!-- Top slider content -->
			  <div class="aa-top-slider-content">
				<span class="aa-top-slider-title"><?=$nek['tip_nekretnine']?></span>
				<h6 class="aa-top-slider-catg" style='letter-spacing:1px;'><?=$nek['adresa']?></h6>
				<p class="aa-top-slider-location"><i class="fa fa-map-marker"></i><?=$nek['grad_naziv']?>, Crna Gora</p>
				<span class="aa-top-slider-off">(<?=ucfirst($nek['tip_oglasa'])?>)</span>
				<p class="aa-top-slider-price"><?=$nek['cijena']?> €</p>
				<a href="properties-detail.php?id=<?=$nek['id']?>" class="aa-top-slider-btn">Detalji <span class="fa fa-angle-double-right"></span></a>
			  </div>
			  <!-- / Top slider content -->
			</div>
			<?php
		}
}

function fill_galery($n=30){
global $db_conn;
			
			$rez = mysqli_query($db_conn,"SELECT * FROM nekretnina WHERE status <> 2 ORDER BY broj_pregleda DESC LIMIT $n");
			while($row = mysqli_fetch_assoc($rez)){
				
				$id =  $row['id'];
				$fotografije = json_decode($row['fotografije'],true);;
				$tip_id = $row['tip_nekretnine'];
				$fotografija = '';
				
				if(is_array($fotografije))
					if(count($fotografije)>0)
						$fotografija = photo_path.$fotografije[0];
				
				if($fotografija == '')continue;
			?>
				<div class="aa-single-gallery mix id<?=$tip_id?>">                  
                  <div class="aa-single-gallery-item">
                    <div class="aa-single-gallery-img">
                      <a href="properties-detail.php?id=<?=$id?>"><img src="<?=$fotografija?>" alt="img"></a>
                    </div>
                    <div class="aa-single-gallery-info">
                      <a class="fancybox" data-fancybox-group="gallery" href="<?=$fotografija?>"><span class="fa fa-eye">
                      <a class="aa-link" href="properties-detail.php?id=<?=$id?>"><span class="fa fa-link"></span></a>
                    </div>                  
                  </div>
                </div>
            <?php } 

}

function doesEstateExists($id){
		global $db_conn;
			
		$rez = mysqli_query($db_conn,"SELECT * FROM nekretnina WHERE id=$id");
		return (mysqli_num_rows($rez) == 0)?false:true;
}

function removePhotos($id, $korisnik_id){
		global $db_conn;
			
		$rez = mysqli_query($db_conn,"SELECT * FROM nekretnina WHERE id=$id AND korisnik_id = $korisnik_id");
		
			$row = mysqli_fetch_assoc($rez);
			$fotografije = json_decode($row['fotografije'],true);
			
			if(is_array($fotografije)){
				if(count($fotografije)>0){
					foreach($fotografije as $fotografija)
						unlink(photo_path.$fotografija);
				}
			}
		
}

function get_top_n($n){
global $db_conn;
			
			$rez = mysqli_query($db_conn,"SELECT * FROM nekretnina WHERE status <> 2 ORDER BY broj_pregleda DESC LIMIT $n");
			while($row = mysqli_fetch_assoc($rez)){
				
				$id =  $row['id'];
				$opis = $row['opis'];
				$cijena = $row['cijena'];
				$povrsina = $row['povrsina'];
				$god_izgradnje = $row['godina_izgradnje']??'?';
				
				$tip_id = $row['tip_nekretnine'];
				$tip_nekretnine = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM tip_nekretnine WHERE id = $tip_id"))['naziv'];
				
				$tip_id = $row['status'];
				$status = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM status_nekretnine WHERE id = $tip_id"))['naziv'];
				
				if($status == 'dostupno'){
				$tip_id = $row['tip_oglasa'];
				$status = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM tip_oglasa WHERE id = $tip_id"))['naziv'];
				}
				
				$class = '';
				$msg = '';
				
				switch($status){
						
					case 'nedostupno': $class = 'sold-out';$msg = 'Prodato'; break;
					case 'prodaja': $class = 'for-sale';$msg = 'Prodaja'; break;
					case 'iznajmljivanje': $class = 'for-rent';$msg = 'Iznajmljivanje'; break;
					case 'kompenzacija': $class = 'for-comp';$msg = 'Kompenzacija'; break;	
				}
				
			?>
            <div class="media">
                <div class="media-left">
                  <a href="properties-detail.php?id=<?=$id?>">
                    <img src="<?=get_first_photo($row)?>" alt="img" width='100px' height='90px'>
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading"><a href="properties-detail.php?id=<?=$id?>"><?=ucfirst($tip_nekretnine)?></a></h4>
                  <p><?=$opis?></p>                
                  <span> <?=$cijena?> €</span>
                </div>              
              </div>
            <?php } 
			
			?>
			<div class="aa-single-advance-search">
				  <form method = 'get' action = 'properties.php'>
				  <input type = 'hidden' name = 'key' value = 'broj_pregleda'> 
                  <input type="submit" value="Pogledaj sve" class="aa-search-btn">
				  </form>
            </div>
			<?php

}

function draw_cards(){
			global $db_conn;
			
			$rez = mysqli_query($db_conn,'SELECT * FROM nekretnina WHERE status <> 2 ORDER BY datum_postavljanja DESC LIMIT 6');
			while($row = mysqli_fetch_assoc($rez)){
				
				$id =  $row['id'];
				$opis = $row['opis'];
				$cijena = $row['cijena'];
				$povrsina = $row['povrsina'];
				$god_izgradnje = $row['godina_izgradnje']??'?';
				
				$tip_id = $row['tip_nekretnine'];
				$tip_nekretnine = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM tip_nekretnine WHERE id = $tip_id"))['naziv'];
				
				$tip_id = $row['status'];
				$status = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM status_nekretnine WHERE id = $tip_id"))['naziv'];
				
				$tip_id = $row['grad'];
				$grad = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM grad WHERE id = $tip_id"))['naziv'];
				
				if($status == 'dostupno'){
				$tip_id = $row['tip_oglasa'];
				$status = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM tip_oglasa WHERE id = $tip_id"))['naziv'];
				}
				
				$class = '';
				$msg = '';
				
				switch($status){
						
					case 'prodato': $class = 'sold-out';$msg = 'Prodato'; break;
					case 'prodaja': $class = 'for-sale';$msg = 'Prodaja'; break;
					case 'iznajmljivanje': $class = 'for-rent';$msg = 'Iznajmljivanje'; break;
					case 'kompenzacija': $class = 'for-comp';$msg = 'Kompenzacija'; break;	
				}
				
			?>
            <div class="col-md-4">
              <article class="aa-properties-item">
                <a href="properties-detail.php?id=<?=$id?>" class="aa-properties-item-img">
                  <img src="<?=get_first_photo($row)?>" alt="img" width='370px' height='220px'>
                </a>
                <div class="aa-tag <?=$class?>">
                  <?=$msg?>
                </div>
                <div class="aa-properties-item-content">
                  <div class="aa-properties-info">
                    <span>Površina: <?=$povrsina?>m<sup>2</sup></span>
					<span style = 'float:right'>Lokacija: <?=$grad?></span>
                    <!--<span>God. izgradnje: <?=$god_izgradnje?></span>-->
                  </div>
                  <div class="aa-properties-about">
                    <h3><a href="properties-detail.php?id=<?=$id?>"><?=ucfirst($tip_nekretnine)?></a></h3>
                    <p><?=$opis?></p>                      
                  </div>
                  <div class="aa-properties-detial">
                    <span class="aa-price">
                      <?=$cijena?> €
                    </span>
                    <a href="properties-detail.php?id=<?=$id?>" class="aa-secondary-btn">Pogledaj detalje</a>
                  </div>
                </div>
              </article>
            </div>
            <?php } 

}

function draw_cards_nearby($id,$tip_oglasa,$tip_nekretnine,$grad){
		global $db_conn;
		
		$rez = mysqli_query($db_conn,"SELECT * FROM nekretnina WHERE status <> 2 AND id <> $id AND tip_oglasa = $tip_oglasa AND tip_nekretnine = $tip_nekretnine AND grad = $grad ORDER BY datum_postavljanja DESC LIMIT 2");
		while($row = mysqli_fetch_assoc($rez)){
			
			$id =  $row['id'];
			$opis = $row['opis'];
			$cijena = $row['cijena'];
			$povrsina = $row['povrsina'];
			$god_izgradnje = $row['godina_izgradnje']??'?';
			
			$tip_id = $row['tip_nekretnine'];
			$tip_nekretnine = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM tip_nekretnine WHERE id = $tip_id"))['naziv'];
			
			$tip_id = $row['status'];
			$status = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM status_nekretnine WHERE id = $tip_id"))['naziv'];
			
			$tip_id = $row['grad'];
			$grad = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM grad WHERE id = $tip_id"))['naziv'];
			
			if($status == 'dostupno'){
			$tip_id = $row['tip_oglasa'];
			$status = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM tip_oglasa WHERE id = $tip_id"))['naziv'];
			}
			
			$class = '';
			$msg = '';
			
			switch($status){
					
				case 'prodato': $class = 'sold-out';$msg = 'Prodato'; break;
				case 'prodaja': $class = 'for-sale';$msg = 'Prodaja'; break;
				case 'iznajmljivanje': $class = 'for-rent';$msg = 'Iznajmljivanje'; break;
				case 'kompenzacija': $class = 'for-comp';$msg = 'Kompenzacija'; break;	
			}
			
		?>
		<div class="col-md-6">
		  <article class="aa-properties-item">
			<a href="properties-detail.php?id=<?=$id?>" class="aa-properties-item-img">
			  <img src="<?=get_first_photo($row)?>" alt="img" width='370px' height='220px'>
			</a>
			<div class="aa-tag <?=$class?>">
			  <?=$msg?>
			</div>
			<div class="aa-properties-item-content">
			  <div class="aa-properties-info">
				<span>Površina: <?=$povrsina?>m<sup>2</sup></span>
				<span style = 'float:right'>Lokacija: <?=$grad?></span>
				<!--<span>God. izgradnje: <?=$god_izgradnje?></span>-->
			  </div>
			  <div class="aa-properties-about">
				<h3><a href="properties-detail.php?id=<?=$id?>"><?=ucfirst($tip_nekretnine)?></a></h3>
				<p><?=$opis?></p>                      
			  </div>
			  <div class="aa-properties-detial">
				<span class="aa-price">
				  <?=$cijena?> €
				</span>
				<a href="properties-detail.php?id=<?=$id?>" class="aa-secondary-btn">Pogledaj detalje</a>
			  </div>
			</div>
		  </article>
		</div>
		<?php } 

}


function draw_cards_list(){
			global $db_conn;
			
			$korisnik_id = isset($_GET['korisnik_id'])?$_GET['korisnik_id']:'';
			
			$key = isset($_GET['key'])?$_GET['key']:'id';
			$limit = isset($_GET['limit'])?$_GET['limit']:'6';
			$offset = isset($_GET['offset'])?$_GET['offset']:'0';
			$offset *= $limit;
			$order = isset($_GET['order'])?$_GET['order']:'DESC';
			
			$tip_oglasa = isset($_GET['tip_oglasa'])?$_GET['tip_oglasa']:'';
			$tip_nek = isset($_GET['tip_nekretnine'])?$_GET['tip_nekretnine']:'';
			$g = isset($_GET['grad'])?$_GET['grad']:'';
			$q = isset($_GET['q'])?$_GET['q']:'';
			$cijena_od = isset($_GET['cijena_od'])?$_GET['cijena_od']:'';
			$cijena_do = isset($_GET['cijena_do'])?$_GET['cijena_do']:'';
			$povrsina_od = isset($_GET['povrsina_od'])?$_GET['povrsina_od']:'';
			$povrsina_do = isset($_GET['povrsina_do'])?$_GET['povrsina_do']:'';
			
			$con = [];
			$con[] = "WHERE status <> 2";
			
			if($g)$con[] = "grad = '$g'";
			
			if($q)$con[] = "opis LIKE LOWER('%$q%')";
			
			if($cijena_od !== '')$con[] = "cijena >= $cijena_od";	
			if($cijena_do !== '')$con[] = "cijena <= $cijena_do";
		
			if($povrsina_od !== '')$con[] = "povrsina >= $povrsina_od";	
			if($povrsina_do !== '')$con[] = "povrsina <= $povrsina_do";
			
			if($korisnik_id !== '')$con[] = "korisnik_id = $korisnik_id";
			
			$con_str = implode(' AND ',$con);
			
			//echo $con_str;
			$rez = mysqli_query($db_conn,"SELECT * FROM nekretnina $con_str ORDER BY $key $order LIMIT $offset,$limit");
			$count = mysqli_num_rows(mysqli_query($db_conn,"SELECT * FROM nekretnina $con_str"));
			while($row = mysqli_fetch_assoc($rez)){
				
				$id =  $row['id'];
				$opis = $row['opis'];
				$cijena = $row['cijena'];
				$povrsina = $row['povrsina'];
				$god_izgradnje = $row['godina_izgradnje']??'?';
				
				
				$tip_id = $row['tip_nekretnine'];
				//echo $tip_nek;
				if(!empty($tip_nek) && ($tip_nek != $tip_id))continue;
				$tip_nekretnine = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM tip_nekretnine WHERE id = $tip_id"))['naziv'];
				
				$tip_id = $row['status'];
				$status = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM status_nekretnine WHERE id = $tip_id"))['naziv'];
				
				$tip_id = $row['grad'];
				$grad = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM grad WHERE id = $tip_id"))['naziv'];
				
				if($status == 'dostupno'){
				$tip_id = $row['tip_oglasa'];
				if(!empty($tip_oglasa) && $tip_oglasa != $tip_id)continue;
				$status = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM tip_oglasa WHERE id = $tip_id"))['naziv'];
				}
				
				$class = '';
				$msg = '';
				
				switch($status){
						
					case 'prodato': $class = 'sold-out';$msg = 'Prodato'; break;
					case 'prodaja': $class = 'for-sale';$msg = 'Prodaja'; break;
					case 'iznajmljivanje': $class = 'for-rent';$msg = 'Iznajmljivanje'; break;
					case 'kompenzacija': $class = 'for-comp';$msg = 'Kompenzacija'; break;	
				}
				
			?>
            <li>
              <article class="aa-properties-item">
                <a href="properties-detail.php?id=<?=$id?>" class="aa-properties-item-img">
                  <img src="<?=get_first_photo($row)?>" alt="img" width='370px' height='220px'>
                </a>
                <div class="aa-tag <?=$class?>">
                  <?=$msg?>
                </div>
                <div class="aa-properties-item-content">
                  <div class="aa-properties-info">
                    <span>Površina: <?=$povrsina?>m<sup>2</sup></span>
					<span style = 'float:right'>Lokacija: <?=$grad?></span>
                    <!--<span>God. izgradnje: <?=$god_izgradnje?></span>-->
                  </div>
                  <div class="aa-properties-about">
                    <h3><a href="properties-detail.php?id=<?=$id?>"><?=ucfirst($tip_nekretnine)?></a></h3>
                    <p><?=$opis?></p>                      
                  </div>
                  <div class="aa-properties-detial">
                    <span class="aa-price">
                      <?=$cijena?> €
                    </span>
                    <a href="properties-detail.php?id=<?=$id?>" class="aa-secondary-btn">Pogledaj detalje</a>
                  </div>
                </div>
              </article>
            </li>
            <?php } 
		return $count;
}

function draw_cards_list_my(){
			global $db_conn;
			global $user;
			
			$korisnik_id = $user['id'];
			
			$key = isset($_GET['key'])?$_GET['key']:'id';
			$limit = isset($_GET['limit'])?$_GET['limit']:'6';
			$offset = isset($_GET['offset'])?$_GET['offset']:'0';
			$offset *= $limit;
			$order = isset($_GET['order'])?$_GET['order']:'DESC';
			
			$tip_oglasa = isset($_GET['tip_oglasa'])?$_GET['tip_oglasa']:'';
			$tip_nek = isset($_GET['tip_nekretnine'])?$_GET['tip_nekretnine']:'';
			$g = isset($_GET['grad'])?$_GET['grad']:'';
			$q = isset($_GET['q'])?$_GET['q']:'';
			$cijena_od = isset($_GET['cijena_od'])?$_GET['cijena_od']:'';
			$cijena_do = isset($_GET['cijena_do'])?$_GET['cijena_do']:'';
			$povrsina_od = isset($_GET['povrsina_od'])?$_GET['povrsina_od']:'';
			$povrsina_do = isset($_GET['povrsina_do'])?$_GET['povrsina_do']:'';
			
			$con = [];
			$con[] = "WHERE korisnik_id = $korisnik_id";
			
			if($g)$con[] = "grad = '$g'";
			
			if($q)$con[] = "opis LIKE LOWER('%$q%')";
			
			if($cijena_od !== '')$con[] = "cijena >= $cijena_od";	
			if($cijena_do !== '')$con[] = "cijena <= $cijena_do";
		
			if($povrsina_od !== '')$con[] = "povrsina >= $povrsina_od";	
			if($povrsina_do !== '')$con[] = "povrsina <= $povrsina_do";
			
			$con_str = implode(' AND ',$con);
			
			//echo $con_str;
			$rez = mysqli_query($db_conn,"SELECT * FROM nekretnina $con_str ORDER BY $key $order LIMIT $offset,$limit");
			$count = mysqli_num_rows(mysqli_query($db_conn,"SELECT * FROM nekretnina $con_str"));
			while($row = mysqli_fetch_assoc($rez)){
				
				$id =  $row['id'];
				$opis = $row['opis'];
				$cijena = $row['cijena'];
				$povrsina = $row['povrsina'];
				$god_izgradnje = $row['godina_izgradnje']??'?';
				
				
				$tip_id = $row['tip_nekretnine'];
				//echo $tip_nek;
				if(!empty($tip_nek) && ($tip_nek != $tip_id))continue;
				$tip_nekretnine = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM tip_nekretnine WHERE id = $tip_id"))['naziv'];
				
				$tip_id = $row['status'];
				$status = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM status_nekretnine WHERE id = $tip_id"))['naziv'];
				
				$tip_id = $row['grad'];
				$grad = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM grad WHERE id = $tip_id"))['naziv'];
				
				if($status == 'dostupno'){
				$tip_id = $row['tip_oglasa'];
				if(!empty($tip_oglasa) && $tip_oglasa != $tip_id)continue;
				$status = mysqli_fetch_assoc(mysqli_query($db_conn,"SELECT naziv FROM tip_oglasa WHERE id = $tip_id"))['naziv'];
				}
				
				$class = '';
				$msg = '';
				
				switch($status){
						
					case 'prodato': $class = 'sold-out';$msg = 'Prodato'; break;
					case 'prodaja': $class = 'for-sale';$msg = 'Prodaja'; break;
					case 'iznajmljivanje': $class = 'for-rent';$msg = 'Iznajmljivanje'; break;
					case 'kompenzacija': $class = 'for-comp';$msg = 'Kompenzacija'; break;	
				}
				
			?>
            <li>
              <article class="aa-properties-item">
                <a href="properties-detail.php?id=<?=$id?>" class="aa-properties-item-img">
                  <img src="<?=get_first_photo($row)?>" alt="img" width='370px' height='220px'>
                </a>
                <div class="aa-tag <?=$class?>">
                  <?=$msg?>
                </div>
                <div class="aa-properties-item-content">
                  <div class="aa-properties-info">
                    <span>Površina: <?=$povrsina?>m<sup>2</sup></span>
					<span style = 'float:right'>Lokacija: <?=$grad?></span>
                    <!--<span>God. izgradnje: <?=$god_izgradnje?></span>-->
                  </div>
                  <div class="aa-properties-about">
                    <h3><a href="properties-detail.php?id=<?=$id?>"><?=ucfirst($tip_nekretnine)?></a></h3>
                    <p><?=$opis?></p>                      
                  </div>
                  <div class="aa-properties-detial">
                    <span class="aa-price">
                      <?=$cijena?> €
                    </span>
                    
					 <a data-del href="properties-remove.php?id=<?=$id?>" title = 'Obrisi oglas' class="aa-secondary-btn a-m1"><i class="fa fa-trash"></i></a>
					<a href="properties-edit.php?id=<?=$id?>" title = 'Izmjeni oglas'  class="aa-secondary-btn a-m1"><i class="fa fa-pencil"></i></a>
					  <a href="properties-detail.php?id=<?=$id?>" title = 'Prikazi detalje' class="aa-secondary-btn">Pogledaj detalje</a>
                  </div>
                </div>
              </article>
            </li>
            <?php } 
		return $count;
}

function emailValidation($email) 
{
    $regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/";
    $email = strtolower($email);

    return preg_match ($regex, $email);
}

function nameValidaiton($username){	
	
	return true;
	
	if (preg_match('/^[a-z\d_]{5,20}$/i', $username)) {
	return true;
	} else {
	return false;
	}
}

function passwordValidation($password){
	
	return (strlen($password) < 8)?false:true;
	
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);

	if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
	  return false;
	}
	
	return true;
}

function getUser(){
	
	session_start();
	$user = null;
	
	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];
	}else if(isset($_COOKIE['user'])){
		$user = unserialize($_COOKIE['user']);
	}
	
	return $user;
}

function logout(){
	session_unset();
	session_destroy();
	
	removeCookie();
	header('Location: ./index.php');
	exit();
}

function nav_bar(){
	global $user;
	if($user):?>
	<a href="#" class="aa-register"><?=$user['username']?></a>
	<a href="signin.php?logout=true" class="aa-login">( logout )</a>
	<?php	else:?>
	<a href="register.php" class="aa-register">Register</a>
	<a href="signin.php" class="aa-login">Login</a>
	<?php endif;
}

function get_photos($nekretnina){
	$fotografije = json_decode($nekretnina['fotografije'],true);
	
	if(!is_array($fotografije)){
		echo "<img src='./img/item/1.jpg' alt='img'>";
		return;
	}
	
	if(count($fotografije) == 0){
		echo "<img src='./img/item/1.jpg' alt='img'>";
		return;
	}
	
	foreach($fotografije as $fotografija){
		$path = photo_path.$fotografija;
		echo "<img src='$path' alt='img'>";
	}	
}

function get_first_photo($nekretnina){
	$fotografije = json_decode($nekretnina['fotografije'],true);
	
	if(!is_array($fotografije))return './img/item/1.jpg';
	if(count($fotografije) == 0)return './img/item/1.jpg';
	
	return photo_path.$fotografije[0];
}


function removeCookie(){	
	if (isset($_COOKIE['user'])) {
		unset($_COOKIE['user']); 
		setcookie('user', null, -1); 
		return true;
	} else {
		return false;
	}
}

function count_traffic(){
	global $db_conn, $config;
	if(!isset($_SESSION['visited'])){
		$_SESSION['visited'] = true;
		$broj_posjeta = $config['broj_posjeta'] + 1;
		mysqli_query($db_conn,"Update agencija SET broj_posjeta = $broj_posjeta");
	}
	
}

function getTotalVisits(){
	global $db_conn;
	$rez = mysqli_query($db_conn,"SELECT broj_posjeta FROM agencija");
	$count = mysqli_fetch_assoc($rez)['broj_posjeta'];
	return $count;
	
}

function getUserCount(){
	global $db_conn;
	$rez = mysqli_query($db_conn,"SELECT count(*) as count FROM korisnik");
	$count = mysqli_fetch_assoc($rez)['count'];
	return $count;
}

function getPropertiesCount(){
	global $db_conn;
	$rez = mysqli_query($db_conn,"SELECT count(*) as count FROM nekretnina WHERE status <> 2");
	$count = mysqli_fetch_assoc($rez)['count'];
	return $count;
}

function getPropertiesValue(){
	global $db_conn;
	$rez = mysqli_query($db_conn,"SELECT sum(cijena) as suma FROM nekretnina WHERE status <> 2");
	$count = mysqli_fetch_assoc($rez)['suma'];
	return $count;
}

function getRevenue(){
	global $db_conn;
	$rez = mysqli_query($db_conn,"SELECT sum(cijena) as suma FROM nekretnina WHERE status = 2");
	$count = mysqli_fetch_assoc($rez)['suma'];
	return $count??0;
}

function get_admin_list(){
	global $db_conn;
			
	$rez = mysqli_query($db_conn,"SELECT n.*, k.email, tn.naziv FROM nekretnina n
	JOIN korisnik k ON k.id = n.korisnik_id
	JOIN tip_nekretnine tn ON tn.id = n.tip_nekretnine
	ORDER BY datum_postavljanja DESC
	LIMIT 10
	");
	while($row = mysqli_fetch_assoc($rez)){
		
		?>
		  <tr>
			<th scope="row"><?=$row['id']?></th>
			<td><?=$row['naziv']?></td>
			<td><?=$row['email']?></td>
			<td><?=$row['cijena']?></td>
			<td><?=$row['datum_postavljanja']?></td>
			<td><a href="../properties-detail.php?id=<?=$row['id']?>" class="btn btn-sm btn-primary">Detalji</a></td>
		  </tr>
		
		<?php
	}
}

function get_user_list($offset=0){
	global $db_conn, $config;
	$admin_id = $config['admin'];
	$rez = mysqli_query($db_conn,"SELECT * FROM korisnik WHERE id <> $admin_id LIMIT 10 OFFSET $offset");
	while($row = mysqli_fetch_assoc($rez)){
		$korisnik_id = $row['id'];
		$rez1 = mysqli_query($db_conn,"SELECT count(*) as count FROM nekretnina WHERE korisnik_id = $korisnik_id");
		$count = mysqli_fetch_assoc($rez1)['count'];
		
		?>
		  <tr>
			<th scope="row"><?=$korisnik_id?></th>
			<td><?=$row['ime']?></td>
			<td><?=$row['email']?></td>
			<td><?=($row['aktiviran'])?'True':'False'?></td>
			<td><?=$count?></td>
			<td><a href="../properties.php?korisnik_id=<?=$korisnik_id?>" class="btn btn-sm btn-primary"><i class= 'fa fa-eye'></i></a></td>
			<td><a href="../user-block.php?id=<?=$korisnik_id?>" <?=confirm_dialog_input();?> class="btn btn-sm btn-danger"><i class= 'fa fa-trash'></i></a></td>
		  </tr>
		
		<?php
	}
}

function fill_select_cities(){
	global $db_conn;
	 
		$rez = mysqli_query($db_conn,'select * from grad');
		while($row = mysqli_fetch_assoc($rez)){
			$id  = $row['id'];
			$naziv = $row['naziv'];
			echo "<option value = '$id' >$naziv</option>";
		}
}

function fill_select_tip_nekretnine(){
	global $db_conn;
	 
		$rez = mysqli_query($db_conn,'select * from tip_nekretnine');
		while($row = mysqli_fetch_assoc($rez)){
			$id  = $row['id'];
			$naziv = $row['naziv'];
			echo "<option value = '$id' >$naziv</option>";
		}
}

function confirm_dialog_input(){
	
return "onclick = 'if(!confirm(\"Da li ste sigurni?\"))event.preventDefault();'";	
}
?>

