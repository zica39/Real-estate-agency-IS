<?php 
	include 'sql_driver.php';
	include '../tools.php';
	include '../global.php';
	if(!isAdmin())header('Loacation:../index.php');
	
	if(isset($_POST['dodaj_tip_nekretnine'])){
		$novi_tip = isset($_POST['novi_tip'])?$_POST['novi_tip']:false;
		if($novi_tip){
			$sql =	"INSERT INTO `tip_nekretnine`(naziv) VALUES ('$novi_tip')";
			$res = mysqli_query($db_conn,$sql);
			if($res){
				header('Location:sifarnik.php?msg=uspjesno dodati novi tip nekretnine');
			}else{
				exit('Greska pri dodavanju novog tipa nekretnine');
			}
		}
		
	}
	
	if(isset($_POST['obrisi_tip_nekretnine'])){
		$obrisani_tip = isset($_POST['obrisani_tip'])?$_POST['obrisani_tip']:false;
		if($obrisani_tip){
			
			 mysqli_query($db_conn,"BEGIN");
			
			$sql1 =	"DELETE FROM `nekretnina` WHERE tip_nekretnine = $obrisani_tip";
			$res = mysqli_query($db_conn,$sql1);
			if($res){
				$sql2 =	"DELETE FROM `tip_nekretnine` WHERE id = $obrisani_tip";
				$res1 = mysqli_query($db_conn,$sql2);
				if($res1){
					header('Location:sifarnik.php?msg=uspjesno dodati novi tip nekretnine');
					mysqli_query($db_conn,"COMMIT");
				}else{
					exit('Greska pri brisanju tipa nekretnine');
					mysqli_query($db_conn,"ROLLBACK");
				}
			}else{
				exit('Greska pri brisanju nekretnina koje su tipa kojeg ste obrisali');
				mysqli_query($db_conn,"ROLLBACK");
			}
		}
		
	}
	
	if(isset($_POST['dodaj_grad'])){
		$novi_grad = isset($_POST['novi_grad'])?$_POST['novi_grad']:false;
		if($novi_grad){
			$sql =	"INSERT INTO `grad`(naziv) VALUES ('$novi_grad')";
			$res = mysqli_query($db_conn,$sql);
			if($res){
				header('Location:sifarnik.php?msg=uspjesno dodati novi grad');
			}else{
				exit('Greska pri dodavanju novog grada');
			}
		}
		
	}
	
	if(isset($_POST['obrisi_grad'])){
		$obrisani_grad = isset($_POST['obrisani_grad'])?$_POST['obrisani_grad']:false;
		if($obrisani_grad){
			
			 mysqli_query($db_conn,"BEGIN");
			
			$sql1 =	"DELETE FROM `nekretnina` WHERE grad = $obrisani_grad";
			$res = mysqli_query($db_conn,$sql1);
			
			if($res){
				$sql2 =	"DELETE FROM `grad` WHERE id = $obrisani_grad";
				$res1 = mysqli_query($db_conn,$sql2);
				if($res1){
					header('Location:sifarnik.php?msg=uspjesno dodati novi grad');
					mysqli_query($db_conn,"COMMIT");
				}else{
					exit('Greska pri brisanju grada');
					mysqli_query($db_conn,"ROLLBACK");
				}
			}else{
				exit('Greska pri brisanju nekretnina koje su u gradu kojeg ste obrisali');
				mysqli_query($db_conn,"ROLLBACK");
			}
		}
		
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sifarnik</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
   
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<link href="../setup/selectbox.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a class="navbar-brand" href="#">
				Dashboard
            </a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="col-12 col-md-4 col-lg-2">
		<form method = 'get' action = '../properties.php' >
            <input class="form-control form-control-dark" name = 'q' type="text" placeholder="Pretrazi nekretnine..." aria-label="Search">
        </form>
		</div>
        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                  Hello, <?=$user['username']?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <!--<li><a class="dropdown-item" href="#">Messages</a></li>-->
                  <li><a class="dropdown-item" href="../signin.php?logout=true">Sign out</a></li>
                </ul>
              </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="index.php">
                            <i class = 'fa fa-bar-chart fa-2x'></i>
							<span class="ml-2 h5">Dashboard</span>
                          </a>
                        </li>
						
						<li class="nav-item">
                          <a class="nav-link" aria-current="page" href="korisnici.php">
                            <i class = 'fa fa-user fa-2x'></i>
							<span class="ml-2 h5">Korisnici</span>
                          </a>
                        </li>
						
						<li class="nav-item">
                          <a class="nav-link" aria-current="page" href="podesavanja.php">
                            <i class = 'fa fa-cog fa-2x'></i>
							<span class="ml-2 h5">Podesavanja</span>
                          </a>
                        </li>
						
						<li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="sifarnik.php">
                            <i class = 'fa fa-book fa-2x'></i>
							<span class="ml-2 h5">Sifarnik</span>
                          </a>
                        </li>
                        
                      </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sifarnik</li>
                    </ol>
                </nav>
                <h1 class="h2">CRUD Sifarnik</h1>
                <div class="row my-4">
                
				<div class="col-12 col-xl-12 mb-12 mb-lg-12">
                        <div class="card">
                            <h5 class="card-header">Sifarnik</h5>
                            <div class="card-body">  
								<div class = 'container'>
									<div class = 'row'>
										<div id="container" class = 'containerBox'>
											<form method='post'>
												<label for="name">Tip nekretnine:</label>
												<input type="text" id="name" name = 'novi_tip' placeholder="Dodaj novi tip nekretnine" autocomplete="off" required>
												<input type = 'submit' class = 'btn btn-success btn-block' value = 'Dodaj' name = 'dodaj_tip_nekretnine'>
											</form>
											<form method='post'>
												<label for="list">Tip nekretnine Lista:</label>
												<select id="list" name="obrisani_tip" size=10>
													 <?php fill_select_tip_nekretnine(); ?>
												</select>
												<input type = 'submit' <?=confirm_dialog_input();?> class = 'btn btn-danger btn-block' value = 'Ukloni oznaceni' name = 'obrisi_tip_nekretnine'>
												<!--<button id="btnRemove">Ukloni oznacenu <i class='fa fa-trash'></i> </button>-->
											</form>
										</div>
										
										<div id="container1" class = 'containerBox offset-1'>
											<form method = 'post'>
												<label for="name1">Grad:</label>
												<input type="text" id="name1" name = 'novi_grad' placeholder="Dodaj novi grad" autocomplete="off" required>
												
												<input type = 'submit' class = 'btn btn-success btn-block' value = 'Dodaj' name = 'dodaj_grad'>
											</form>
											<form method = 'post'>
												<label for="list1">Lista gradova:</label>
												<select id="list1" name = 'obrisani_grad' size=10>
												<?php fill_select_cities(); ?>
												</select>
												<input type = 'submit' <?=confirm_dialog_input();?> class = 'btn btn-danger btn-block' value = 'Ukloni oznaceni' name = 'obrisi_grad'>
											</form>
										</div>
									</div>
								</div>
						</div>
					</div>
				</div> 
                
                <footer class="pt-5 d-flex justify-content-between">
                    <span>Copyright © <?=date('Y')?> <a href="../index.php"><?=$config['naziv']?></a></span>
                </footer>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
   
</body>
</html>